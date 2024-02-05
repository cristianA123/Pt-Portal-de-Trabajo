<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            DB::table('users')->insert([
                'name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('123456'),
                'birthday' => $faker->date,
                'role' => 'candidate',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        DB::table('users')->insert([
            'name' => 'cristian',
            'last_name' => 'chipana',
            'email' => 'cristian@gmail.com',
            'password' => bcrypt('123456'),
            'birthday' => $faker->date,
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('candidates')->insert([
            'document_number' => $faker->numerify('########'),
            'document_type' => $faker->randomElement(['DNI', 'Passport']),
            'user_id' => 11, // Ajusta esto según tus necesidades
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
