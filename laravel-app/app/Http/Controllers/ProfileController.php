<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function updateProfile(Request $request): RedirectResponse
    {
        $user = auth()->user();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'gender' => ['required', 'string', 'in:male,female,other'],
            'date_of_birth' => ['required', 'date', 'before:today'],
            'location_address' => ['nullable', 'string', 'max:255'],
            'location_latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'location_longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'coach_gym_locations' => ['nullable', 'string'],
            'coach_phone_number' => ['nullable', 'string', 'max:30'],
            'coach_whatsapp_number' => ['nullable', 'string', 'max:30'],
            'gym_name' => ['nullable', 'string', 'max:255'],
            'gym_open_time' => ['nullable', 'date_format:H:i'],
            'gym_close_time' => ['nullable', 'date_format:H:i'],
        ], [], [
            'gender' => 'gender',
            'date_of_birth' => 'date of birth',
            'location_address' => 'location address',
            'location_latitude' => 'location latitude',
            'location_longitude' => 'location longitude',
            'coach_gym_locations' => 'coach gym locations',
            'coach_phone_number' => 'coach phone number',
            'coach_whatsapp_number' => 'coach WhatsApp number',
            'gym_name' => 'gym name',
            'gym_open_time' => 'gym open time',
            'gym_close_time' => 'gym close time',
        ]);

        if ($user->role === 'coach') {
            $rawGymLocations = $data['coach_gym_locations'] ?? null;
            $decodedGymLocations = is_string($rawGymLocations) ? json_decode($rawGymLocations, true) : null;

            if (!is_array($decodedGymLocations)) {
                $decodedGymLocations = [];
            }

            $data['coach_gym_locations'] = collect($decodedGymLocations)
                ->filter(fn ($gym): bool => is_array($gym))
                ->map(function (array $gym): array {
                    return [
                        'address' => (string) Arr::get($gym, 'address', ''),
                        'latitude' => is_numeric(Arr::get($gym, 'latitude')) ? (float) Arr::get($gym, 'latitude') : null,
                        'longitude' => is_numeric(Arr::get($gym, 'longitude')) ? (float) Arr::get($gym, 'longitude') : null,
                    ];
                })
                ->filter(fn (array $gym): bool => $gym['address'] !== '' || ($gym['latitude'] !== null && $gym['longitude'] !== null))
                ->values()
                ->all();

            DB::table('coaches')->updateOrInsert(
                ['user_id' => $user->id],
                [
                    'name' => $data['name'],
                    'phone_number' => $data['coach_phone_number'] ?? null,
                    'whatsapp_number' => $data['coach_whatsapp_number'] ?? null,
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        } else {
            unset($data['coach_gym_locations'], $data['coach_phone_number'], $data['coach_whatsapp_number']);
        }

        if ($user->role !== 'admin') {
            unset($data['gym_name'], $data['gym_open_time'], $data['gym_close_time']);
        } else {
            $openTime = $data['gym_open_time'] ?? null;
            $closeTime = $data['gym_close_time'] ?? null;

            if ($openTime && $closeTime && $openTime >= $closeTime) {
                return back()->withErrors([
                    'gym_close_time' => 'Gym close time must be later than open time.',
                ]);
            }
        }

        $user->update($data);

        return back()->with('status', 'Profile updated successfully!');
    }
}
