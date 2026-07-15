<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('suppliers')->insert([
            'user_id' => null,
            'supplier' =>'Natura',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('suppliers')->insert([
            'user_id' => null,
            'supplier' =>'Avon',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('suppliers')->insert([
            'user_id' => null,
            'supplier' =>'Boticario',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}