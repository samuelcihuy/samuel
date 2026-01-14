<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
        ['name'=>'Laptop','description'=>'Laptop Gaming','price'=>12000000,'stock'=>10],
        ['name'=>'Mouse','description'=>'Mouse Wireless','price'=>150000,'stock'=>50],
    ]);
    }
}
