<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class AppDataController extends Controller
{
    public function index(): JsonResponse
    {
        $products = DB::table('products')
            ->orderBy('id')
            ->get(['id', 'name', 'category', 'price', 'stock', 'image', 'description'])
            ->map(fn (object $product): array => [
                'id' => (string) $product->id,
                'name' => $product->name,
                'category' => $product->category,
                'price' => (float) $product->price,
                'stock' => (int) $product->stock,
                'image' => $product->image,
                'description' => $product->description,
            ])
            ->values();

        $coaches = $this->coaches();
        $workouts = $this->workouts();
        $clients = $this->clients($workouts);

        return response()->json([
            'products' => $products,
            'coaches' => $coaches,
            'workouts' => $workouts->values(),
            'clients' => $clients,
            'gyms' => $this->gyms(),
        ]);
    }

    private function gyms(): Collection
    {
        return DB::table('users')
            ->where('role', 'admin')
            ->where(function ($query): void {
                $query->whereNotNull('gym_name')
                    ->orWhereNotNull('location_address');
            })
            ->orderBy('id')
            ->get([
                'id',
                'gym_name',
                'location_address',
                'location_latitude',
                'location_longitude',
                'gym_open_time',
                'gym_close_time',
            ])
            ->map(function (object $gym): array {
                $open = $gym->gym_open_time ? date('g:i A', strtotime((string) $gym->gym_open_time)) : null;
                $close = $gym->gym_close_time ? date('g:i A', strtotime((string) $gym->gym_close_time)) : null;

                return [
                    'id' => 'gym-'.$gym->id,
                    'name' => $gym->gym_name ?: 'Gym #'.$gym->id,
                    'location' => $gym->location_address ?: 'Location not set',
                    'open' => $open && $close ? "Open {$open} - {$close}" : 'Hours not set',
                    'amenities' => ['Weights', 'Cardio'],
                    'latitude' => $gym->location_latitude !== null ? (float) $gym->location_latitude : null,
                    'longitude' => $gym->location_longitude !== null ? (float) $gym->location_longitude : null,
                ];
            })
            ->values();
    }

    private function coaches(): Collection
    {
        $clientCounts = DB::table('coach_member')
            ->selectRaw('coach_id, COUNT(*) as clients')
            ->groupBy('coach_id')
            ->pluck('clients', 'coach_id');

        return DB::table('coaches')
            ->orderBy('id')
            ->get(['id', 'name', 'specialty', 'rating', 'sessions', 'phone_number', 'whatsapp_number'])
            ->values()
            ->map(function (object $coach, int $index) use ($clientCounts): array {
                return [
                    'id' => (string) $coach->id,
                    'name' => $coach->name,
                    'specialty' => $coach->specialty,
                    'clients' => (int) ($clientCounts[$coach->id] ?? 0),
                    'gradient' => $this->gradientForIndex($index),
                    'initials' => $this->initials($coach->name),
                    'sessions' => (int) $coach->sessions,
                    'rating' => (float) $coach->rating,
                    'phone_number' => $coach->phone_number ?: '+971500000000',
                    'whatsapp_number' => $coach->whatsapp_number ?: '+971500000000',
                    'supports_in_app' => true,
                ];
            });
    }

    private function workouts(): Collection
    {
        $exerciseRows = DB::table('exercises')
            ->orderBy('id')
            ->get(['workout_id', 'name', 'sets', 'reps', 'intensity', 'muscles', 'description'])
            ->groupBy('workout_id')
            ->map(fn (Collection $rows): array => $rows->map(fn (object $exercise): array => [
                'name' => $exercise->name,
                'sets' => (int) $exercise->sets,
                'reps' => (int) $exercise->reps,
                'intensity' => $exercise->intensity,
                'muscles' => $exercise->muscles,
                'description' => $exercise->description,
            ])->values()->all());

        return DB::table('workouts')
            ->leftJoin('coaches', 'coaches.id', '=', 'workouts.coach_id')
            ->orderBy('workouts.date')
            ->orderBy('workouts.time')
            ->get([
                'workouts.id',
                'workouts.coach_id',
                'workouts.name',
                'workouts.date',
                'workouts.time',
                'workouts.status',
                'coaches.name as coach_name',
            ])
            ->map(function (object $workout) use ($exerciseRows): array {
                return [
                    'id' => (int) $workout->id,
                    'coach_id' => $workout->coach_id ? (int) $workout->coach_id : null,
                    'name' => $workout->name,
                    'coach' => $workout->coach_name ?: 'Unassigned Coach',
                    'date' => (string) $workout->date,
                    'time' => date('g:i A', strtotime((string) $workout->time)),
                    'status' => $workout->status,
                    'exercises' => $exerciseRows[$workout->id] ?? [],
                ];
            })
            ->values();
    }

    private function clients(Collection $workouts): Collection
    {
        $workoutsByCoach = $workouts->groupBy('coach_id');

        return DB::table('coach_member')
            ->join('users', 'users.id', '=', 'coach_member.user_id')
            ->join('coaches', 'coaches.id', '=', 'coach_member.coach_id')
            ->orderBy('users.name')
            ->get([
                'users.id as user_id',
                'users.name',
                'users.email',
                'coach_member.goal',
                'coach_member.coach_id',
            ])
            ->map(function (object $client, int $index) use ($workoutsByCoach): array {
                return [
                    'id' => (string) $client->user_id,
                    'name' => $client->name,
                    'email' => $client->email,
                    'goal' => $client->goal,
                    'initials' => $this->initials($client->name),
                    'gradient' => $this->gradientForIndex($index + 3),
                    'workouts' => ($workoutsByCoach[(int) $client->coach_id] ?? collect())->values()->all(),
                ];
            })
            ->values();
    }

    private function initials(string $name): string
    {
        $parts = preg_split('/\s+/', trim($name)) ?: [];
        $initials = '';

        foreach (array_slice($parts, 0, 2) as $part) {
            $initials .= strtoupper(substr($part, 0, 1));
        }

        return $initials ?: 'U';
    }

    private function gradientForIndex(int $index): string
    {
        $gradients = [
            '135deg,#4facfe,#a855f7',
            '135deg,#22c55e,#16a34a',
            '135deg,#f97316,#ef4444',
            '135deg,#6366f1,#8b5cf6',
            '135deg,#ec4899,#f97316',
            '135deg,#0ea5e9,#14b8a6',
        ];

        return $gradients[$index % count($gradients)];
    }
}
