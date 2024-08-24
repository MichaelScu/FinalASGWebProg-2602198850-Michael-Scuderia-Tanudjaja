<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use FAKER\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $faker = Faker::create("en_EN");
        for ($i = 0; $i < 20; $i++) {
            DB::table('users')->insert([
                'name' => $faker->name(),
                'email' => $faker->email(),
                'password' => Hash::make('dsadsadsa'),
                'gender' => $faker->randomElement($array = ['Male', 'Female']),
                'hobby' => $faker->jobTitle(),
                'mobile_number' => $faker->phoneNumber(),
                'has_paid' => 1,
                'register_price' => rand(100000, 125000),
                'profile_path' => 'profile_image/' . $faker->numberBetween(1, 3) . '.jpeg',
            ]);
        }
        for ($i=0; $i < 20; $i++){
            DB::table('friend_requests')->insert([
                'sender_id' => $faker->numberBetween(1,20),
                'receiver_id' => $faker->numberBetween(1,20)
            ]);
        }

        for ($i=0; $i < 20; $i++){
            DB::table('friends')->insert([
                'user_id' => $faker->numberBetween(1,20),
                'friend_id' => $faker->numberBetween(1,20)
            ]);
        }
    }
}
