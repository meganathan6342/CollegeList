<?php

namespace Database\Seeders;

use App\Models\CollegesModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CollegesSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        for($i = 0; $i < 30; $i++) {
            CollegesModel::create([
                'college_id' => $i,
                'college_name' => $faker->name,
                'address_id' => $faker->number,
            ]);
        }
    }
}
