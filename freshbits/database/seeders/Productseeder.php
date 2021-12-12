<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Productseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('products')->insert([
            'name' => 'Mi',
            'price' => 5000,
            'upc' => 1234567890123,
            'status' => 1,
            'image' => 'image',
        ]);
    }
}
