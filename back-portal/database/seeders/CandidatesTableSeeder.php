<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CandidatesTableSeeder extends Seeder
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
            DB::table('candidates')->insert([
                'document_number' => $faker->numerify('########'),
                'document_type' => $faker->randomElement(['DNI', 'Passport']),
                'user_id' => $index, // Ajusta esto según tus necesidades
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
