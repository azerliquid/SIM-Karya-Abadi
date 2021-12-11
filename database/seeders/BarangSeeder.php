<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');   

        for ($i=0; $i < 30; $i++) { 
            DB::table('barang')->insert([
                'name' => $faker->name(),
                'unit'=> $faker->word(),   
                'stock_now' => $faker->randomDigit(),    
                'deleted' => 0,    
            ]);
        }
    }
}
