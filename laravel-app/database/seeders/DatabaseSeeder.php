<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $password = Hash::make('password');

        $john = User::updateOrCreate(
            ['email' => 'john@example.com'],
            ['name' => 'John Doe', 'role' => 'member', 'password' => $password, 'gender' => 'male', 'date_of_birth' => '1990-05-15']
        );

        $emma = User::updateOrCreate(
            ['email' => 'emma@example.com'],
            ['name' => 'Emma Wilson', 'role' => 'member', 'password' => $password, 'gender' => 'female', 'date_of_birth' => '1995-08-22']
        );

        $sarahUser = User::updateOrCreate(
            ['email' => 'sarah@example.com'],
            ['name' => 'Sarah Johnson', 'role' => 'coach', 'password' => $password, 'gender' => 'female', 'date_of_birth' => '1988-03-10']
        );

        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin User', 'role' => 'admin', 'password' => $password, 'gender' => null, 'date_of_birth' => null]
        );

        DB::table('order_items')->delete();
        DB::table('orders')->delete();
        DB::table('check_ins')->delete();
        DB::table('exercises')->delete();
        DB::table('workouts')->delete();
        DB::table('coach_member')->delete();
        DB::table('coaches')->delete();
        DB::table('products')->delete();

        DB::table('products')->insert([
            [
                'name' => 'Whey Protein 5lb',
                'category' => 'supplement',
                'price' => 49.99,
                'stock' => 50,
                'image' => 'https://images.unsplash.com/photo-1593095948071-474c5cc2989d?w=400',
                'description' => 'Premium whey protein isolate for muscle recovery',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pre-Workout Boost',
                'category' => 'supplement',
                'price' => 34.99,
                'stock' => 30,
                'image' => 'https://images.unsplash.com/photo-1579722821273-0f6c7d44362f?w=400',
                'description' => 'Energy and focus enhancement formula',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Resistance Bands Set',
                'category' => 'equipment',
                'price' => 24.99,
                'stock' => 75,
                'image' => 'https://images.unsplash.com/photo-1598289431512-b97b0917affc?w=400',
                'description' => 'Professional grade resistance bands - 5 levels',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Yoga Mat Premium',
                'category' => 'equipment',
                'price' => 39.99,
                'stock' => 40,
                'image' => 'https://images.unsplash.com/photo-1601925260368-ae2f83cf8b7f?w=400',
                'description' => 'Non-slip eco-friendly yoga mat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'BCAA Recovery',
                'category' => 'supplement',
                'price' => 29.99,
                'stock' => 60,
                'image' => 'https://images.unsplash.com/photo-1584464491033-06628f3a6b7b?w=400',
                'description' => 'Branch chain amino acids for faster recovery',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kettlebell 20kg',
                'category' => 'equipment',
                'price' => 79.99,
                'stock' => 15,
                'image' => 'https://images.unsplash.com/photo-1517836357463-d25dfeac3438?w=400',
                'description' => 'Cast iron kettlebell with comfort grip',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $sarahCoachId = DB::table('coaches')->insertGetId([
            'user_id' => $sarahUser->id,
            'name' => 'Sarah Johnson',
            'specialty' => 'HIIT & Strength',
            'phone_number' => '+971501112233',
            'whatsapp_number' => '+971501112233',
            'rating' => 4.9,
            'sessions' => 48,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $mikeCoachId = DB::table('coaches')->insertGetId([
            'user_id' => null,
            'name' => 'Mike Davis',
            'specialty' => 'Yoga & Flexibility',
            'phone_number' => '+971502223344',
            'whatsapp_number' => '+971502223344',
            'rating' => 4.8,
            'sessions' => 62,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('coaches')->insert([
            'user_id' => null,
            'name' => 'Alex Rivera',
            'specialty' => 'Bodybuilding',
            'phone_number' => '+971503334455',
            'whatsapp_number' => '+971503334455',
            'rating' => 4.7,
            'sessions' => 35,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('coach_member')->insert([
            [
                'coach_id' => $sarahCoachId,
                'user_id' => $john->id,
                'goal' => 'Build muscle mass and increase strength',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'coach_id' => $mikeCoachId,
                'user_id' => $emma->id,
                'goal' => 'Weight loss and cardio endurance',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $hiitWorkoutId = DB::table('workouts')->insertGetId([
            'name' => 'HIIT Training',
            'coach_id' => $sarahCoachId,
            'date' => '2026-04-06',
            'time' => '10:00:00',
            'status' => 'Scheduled',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $strengthWorkoutId = DB::table('workouts')->insertGetId([
            'name' => 'Strength & Conditioning',
            'coach_id' => $sarahCoachId,
            'date' => '2026-04-08',
            'time' => '14:00:00',
            'status' => 'Scheduled',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $yogaWorkoutId = DB::table('workouts')->insertGetId([
            'name' => 'Yoga Flow',
            'coach_id' => $mikeCoachId,
            'date' => '2026-04-10',
            'time' => '18:00:00',
            'status' => 'Scheduled',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('exercises')->insert([
            [
                'workout_id' => $hiitWorkoutId,
                'name' => 'Burpees',
                'sets' => 3,
                'reps' => 10,
                'intensity' => 'High',
                'muscles' => 'Full body',
                'description' => 'A powerful full-body plyometric movement.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'workout_id' => $hiitWorkoutId,
                'name' => 'Mountain Climbers',
                'sets' => 3,
                'reps' => 20,
                'intensity' => 'High',
                'muscles' => 'Core, shoulders',
                'description' => 'Explosive core and cardio exercise in plank.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'workout_id' => $hiitWorkoutId,
                'name' => 'Jump Squats',
                'sets' => 3,
                'reps' => 15,
                'intensity' => 'High',
                'muscles' => 'Quads, glutes',
                'description' => 'Dynamic lower-body move for power.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'workout_id' => $strengthWorkoutId,
                'name' => 'Deadlifts',
                'sets' => 4,
                'reps' => 8,
                'intensity' => 'High',
                'muscles' => 'Hamstrings, glutes',
                'description' => 'Major posterior-chain lift.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'workout_id' => $strengthWorkoutId,
                'name' => 'Bench Press',
                'sets' => 4,
                'reps' => 10,
                'intensity' => 'Medium',
                'muscles' => 'Chest, triceps',
                'description' => 'Classic upper-body press.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'workout_id' => $strengthWorkoutId,
                'name' => 'Pull-ups',
                'sets' => 3,
                'reps' => 8,
                'intensity' => 'High',
                'muscles' => 'Lats, biceps',
                'description' => 'Bodyweight pulling exercise.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'workout_id' => $yogaWorkoutId,
                'name' => 'Sun Salutation',
                'sets' => 5,
                'reps' => 1,
                'intensity' => 'Low',
                'muscles' => 'Full body',
                'description' => 'Flowing warm-up sequence.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'workout_id' => $yogaWorkoutId,
                'name' => 'Warrior Pose',
                'sets' => 3,
                'reps' => 30,
                'intensity' => 'Low',
                'muscles' => 'Legs, core',
                'description' => 'Grounding standing pose.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'workout_id' => $yogaWorkoutId,
                'name' => "Child's Pose",
                'sets' => 3,
                'reps' => 60,
                'intensity' => 'Low',
                'muscles' => 'Back, hips',
                'description' => 'Restorative hip stretch.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
