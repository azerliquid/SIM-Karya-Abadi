<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i=0; $i < 10 ; $i++) { 
            DB::table('project')->insert([
                'name_project' => $faker->name(),
                'head_project' => $i+1,
                'location' => $faker->address(),
            ]);
        }
    }
}
