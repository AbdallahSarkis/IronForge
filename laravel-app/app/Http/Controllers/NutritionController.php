<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NutritionController extends Controller
{
    private const DEFAULT_TARGETS = [
        'target_calories' => 2200,
        'max_calories' => 2500,
        'target_carbs' => 250,
        'max_carbs' => 300,
        'target_protein' => 150,
        'max_protein' => 190,
    ];

    public function memberSummary(Request $request): JsonResponse
    {
        $user = $request->user();
        $date = $request->query('date', now()->toDateString());

        $profile = DB::table('nutrition_profiles')
            ->where('user_id', $user->id)
            ->first();

        $targets = $this->targetsFromProfile($profile);
        $entries = $this->memberEntriesForDate($user->id, $date);
        $consumed = $this->totalsFromEntries($entries);

        return response()->json([
            'date' => $date,
            'targets' => $targets,
            'consumed' => $consumed,
            'entries' => $entries,
        ]);
    }

    public function storeMemberEntry(Request $request): JsonResponse
    {
        $user = $request->user();

        $data = $request->validate([
            'entry_date' => ['required', 'date'],
            'meal_name' => ['required', 'string', 'max:255'],
            'calories' => ['required', 'integer', 'min:0', 'max:9999'],
            'carbs' => ['required', 'integer', 'min:0', 'max:999'],
            'protein' => ['required', 'integer', 'min:0', 'max:999'],
            'notes' => ['nullable', 'string', 'max:255'],
        ]);

        DB::table('nutrition_entries')->insert([
            'user_id' => $user->id,
            'entry_date' => $data['entry_date'],
            'meal_name' => $data['meal_name'],
            'calories' => $data['calories'],
            'carbs' => $data['carbs'],
            'protein' => $data['protein'],
            'notes' => $data['notes'] ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $entries = $this->memberEntriesForDate($user->id, $data['entry_date']);

        return response()->json([
            'message' => 'Nutrition entry added successfully.',
            'entries' => $entries,
            'consumed' => $this->totalsFromEntries($entries),
        ]);
    }

    public function specialistMembers(Request $request): JsonResponse
    {
        $today = now()->toDateString();

        $todaysTotals = DB::table('nutrition_entries')
            ->selectRaw('user_id, SUM(calories) as calories, SUM(carbs) as carbs, SUM(protein) as protein, COUNT(*) as meals')
            ->whereDate('entry_date', $today)
            ->groupBy('user_id')
            ->get()
            ->keyBy('user_id');

        $members = DB::table('users')
            ->leftJoin('nutrition_profiles', 'nutrition_profiles.user_id', '=', 'users.id')
            ->where('users.role', 'member')
            ->orderBy('users.name')
            ->get([
                'users.id',
                'users.name',
                'users.email',
                'nutrition_profiles.target_calories',
                'nutrition_profiles.max_calories',
                'nutrition_profiles.target_carbs',
                'nutrition_profiles.max_carbs',
                'nutrition_profiles.target_protein',
                'nutrition_profiles.max_protein',
            ])
            ->map(function (object $member) use ($todaysTotals): array {
                $totals = $todaysTotals->get($member->id);

                return [
                    'id' => (int) $member->id,
                    'name' => $member->name,
                    'email' => $member->email,
                    'targets' => [
                        'target_calories' => (int) ($member->target_calories ?? self::DEFAULT_TARGETS['target_calories']),
                        'max_calories' => (int) ($member->max_calories ?? self::DEFAULT_TARGETS['max_calories']),
                        'target_carbs' => (int) ($member->target_carbs ?? self::DEFAULT_TARGETS['target_carbs']),
                        'max_carbs' => (int) ($member->max_carbs ?? self::DEFAULT_TARGETS['max_carbs']),
                        'target_protein' => (int) ($member->target_protein ?? self::DEFAULT_TARGETS['target_protein']),
                        'max_protein' => (int) ($member->max_protein ?? self::DEFAULT_TARGETS['max_protein']),
                    ],
                    'today' => [
                        'calories' => (int) ($totals->calories ?? 0),
                        'carbs' => (int) ($totals->carbs ?? 0),
                        'protein' => (int) ($totals->protein ?? 0),
                        'meals' => (int) ($totals->meals ?? 0),
                    ],
                ];
            })
            ->values();

        return response()->json([
            'date' => $today,
            'members' => $members,
        ]);
    }

    public function updateMemberTargets(Request $request, int $member): JsonResponse
    {
        $specialist = $request->user();

        $exists = DB::table('users')
            ->where('id', $member)
            ->where('role', 'member')
            ->exists();

        if (! $exists) {
            return response()->json(['message' => 'Member not found.'], 404);
        }

        $data = $request->validate([
            'target_calories' => ['required', 'integer', 'min:500', 'max:6000'],
            'max_calories' => ['required', 'integer', 'min:500', 'max:7000'],
            'target_carbs' => ['required', 'integer', 'min:20', 'max:1000'],
            'max_carbs' => ['required', 'integer', 'min:20', 'max:1200'],
            'target_protein' => ['required', 'integer', 'min:20', 'max:600'],
            'max_protein' => ['required', 'integer', 'min:20', 'max:800'],
        ]);

        if ($data['max_calories'] < $data['target_calories']
            || $data['max_carbs'] < $data['target_carbs']
            || $data['max_protein'] < $data['target_protein']) {
            return response()->json([
                'message' => 'Max values must be greater than or equal to target values.',
            ], 422);
        }

        DB::table('nutrition_profiles')->updateOrInsert(
            ['user_id' => $member],
            [
                'nutrition_specialist_user_id' => $specialist->id,
                'target_calories' => $data['target_calories'],
                'max_calories' => $data['max_calories'],
                'target_carbs' => $data['target_carbs'],
                'max_carbs' => $data['max_carbs'],
                'target_protein' => $data['target_protein'],
                'max_protein' => $data['max_protein'],
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        return response()->json([
            'message' => 'Nutrition targets updated successfully.',
        ]);
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function memberEntriesForDate(int $userId, string $date): array
    {
        return DB::table('nutrition_entries')
            ->where('user_id', $userId)
            ->whereDate('entry_date', $date)
            ->orderBy('created_at')
            ->get(['id', 'entry_date', 'meal_name', 'calories', 'carbs', 'protein', 'notes', 'created_at'])
            ->map(fn (object $entry): array => [
                'id' => (int) $entry->id,
                'entry_date' => $entry->entry_date,
                'meal_name' => $entry->meal_name,
                'calories' => (int) $entry->calories,
                'carbs' => (int) $entry->carbs,
                'protein' => (int) $entry->protein,
                'notes' => $entry->notes,
                'time' => date('g:i A', strtotime((string) $entry->created_at)),
            ])
            ->values()
            ->all();
    }

    /**
     * @param  array<int, array<string, mixed>>  $entries
     * @return array<string, int>
     */
    private function totalsFromEntries(array $entries): array
    {
        return [
            'calories' => (int) collect($entries)->sum('calories'),
            'carbs' => (int) collect($entries)->sum('carbs'),
            'protein' => (int) collect($entries)->sum('protein'),
        ];
    }

    public function updateMemberEntry(Request $request, int $entry): JsonResponse
    {
        $user = $request->user();

        $row = DB::table('nutrition_entries')->where('id', $entry)->where('user_id', $user->id)->first();
        if (! $row) {
            return response()->json(['message' => 'Entry not found.'], 404);
        }

        $data = $request->validate([
            'meal_name' => ['required', 'string', 'max:255'],
            'calories'  => ['required', 'integer', 'min:0', 'max:9999'],
            'carbs'     => ['required', 'integer', 'min:0', 'max:999'],
            'protein'   => ['required', 'integer', 'min:0', 'max:999'],
            'notes'     => ['nullable', 'string', 'max:255'],
        ]);

        DB::table('nutrition_entries')->where('id', $entry)->update(array_merge($data, ['updated_at' => now()]));

        $entries  = $this->memberEntriesForDate($user->id, $row->entry_date);

        return response()->json([
            'message'  => 'Entry updated.',
            'entries'  => $entries,
            'consumed' => $this->totalsFromEntries($entries),
        ]);
    }

    public function deleteMemberEntry(Request $request, int $entry): JsonResponse
    {
        $user = $request->user();

        $row = DB::table('nutrition_entries')->where('id', $entry)->where('user_id', $user->id)->first();
        if (! $row) {
            return response()->json(['message' => 'Entry not found.'], 404);
        }

        DB::table('nutrition_entries')->where('id', $entry)->delete();

        $entries = $this->memberEntriesForDate($user->id, $row->entry_date);

        return response()->json([
            'message'  => 'Entry deleted.',
            'entries'  => $entries,
            'consumed' => $this->totalsFromEntries($entries),
        ]);
    }

    public function memberBodyComposition(Request $request): JsonResponse
    {
        $user    = $request->user();
        $profile = DB::table('nutrition_profiles')->where('user_id', $user->id)->first();
        $history = $this->bodyHistory($user->id);

        return response()->json([
            'height_cm'        => $profile->height_cm ? (float) $profile->height_cm : null,
            'weight_kg'        => $profile->weight_kg ? (float) $profile->weight_kg : null,
            'body_fat_percent' => $profile->body_fat_percent ? (float) $profile->body_fat_percent : null,
            'muscle_mass_kg'   => $profile->muscle_mass_kg ? (float) $profile->muscle_mass_kg : null,
            'waist_cm'         => $profile->waist_cm ? (float) $profile->waist_cm : null,
            'saved_at'         => $profile->updated_at ?? null,
            'history'          => $history,
        ]);
    }

    public function saveMemberBodyComposition(Request $request): JsonResponse
    {
        $user = $request->user();

        $data = $request->validate([
            'height_cm'        => ['required', 'numeric', 'min:50', 'max:280'],
            'weight_kg'        => ['required', 'numeric', 'min:20', 'max:500'],
            'body_fat_percent' => ['nullable', 'numeric', 'min:1', 'max:70'],
            'muscle_mass_kg'   => ['nullable', 'numeric', 'min:5', 'max:200'],
            'waist_cm'         => ['nullable', 'numeric', 'min:30', 'max:300'],
        ]);

        DB::table('nutrition_profiles')->updateOrInsert(
            ['user_id' => $user->id],
            array_merge($data, ['updated_at' => now(), 'created_at' => now()])
        );

        // Persist daily history snapshot (upsert by user + date)
        $bmi = round($data['weight_kg'] / (($data['height_cm'] / 100) ** 2), 2);
        DB::table('body_composition_history')->updateOrInsert(
            ['user_id' => $user->id, 'recorded_date' => now()->toDateString()],
            [
                'weight_kg'        => $data['weight_kg'],
                'height_cm'        => $data['height_cm'],
                'bmi'              => $bmi,
                'body_fat_percent' => $data['body_fat_percent'] ?? null,
                'muscle_mass_kg'   => $data['muscle_mass_kg'] ?? null,
                'waist_cm'         => $data['waist_cm'] ?? null,
                'updated_at'       => now(),
                'created_at'       => now(),
            ]
        );

        $history = $this->bodyHistory($user->id);

        return response()->json([
            'message'  => 'Body composition saved successfully.',
            'saved_at' => now()->toDateTimeString(),
            'history'  => $history,
        ]);
    }

    private function bodyHistory(int $userId): array
    {
        return DB::table('body_composition_history')
            ->where('user_id', $userId)
            ->orderByDesc('recorded_date')
            ->limit(30)
            ->get(['recorded_date', 'weight_kg', 'bmi', 'body_fat_percent', 'muscle_mass_kg', 'waist_cm'])
            ->map(fn (object $r): array => [
                'date'             => $r->recorded_date,
                'weight_kg'        => (float) $r->weight_kg,
                'bmi'              => (float) $r->bmi,
                'body_fat_percent' => $r->body_fat_percent ? (float) $r->body_fat_percent : null,
                'muscle_mass_kg'   => $r->muscle_mass_kg ? (float) $r->muscle_mass_kg : null,
                'waist_cm'         => $r->waist_cm ? (float) $r->waist_cm : null,
            ])
            ->values()
            ->all();
    }

    /**
     * @return array<string, int>
     */
    private function targetsFromProfile(?object $profile): array
    {
        return [
            'target_calories' => (int) ($profile->target_calories ?? self::DEFAULT_TARGETS['target_calories']),
            'max_calories' => (int) ($profile->max_calories ?? self::DEFAULT_TARGETS['max_calories']),
            'target_carbs' => (int) ($profile->target_carbs ?? self::DEFAULT_TARGETS['target_carbs']),
            'max_carbs' => (int) ($profile->max_carbs ?? self::DEFAULT_TARGETS['max_carbs']),
            'target_protein' => (int) ($profile->target_protein ?? self::DEFAULT_TARGETS['target_protein']),
            'max_protein' => (int) ($profile->max_protein ?? self::DEFAULT_TARGETS['max_protein']),
        ];
    }
}
