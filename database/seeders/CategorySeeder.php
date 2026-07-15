<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'user_id' => null,
                'category' => 'Perfume',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => null,
                'category' => 'Sabonete',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => null,
                'category' => 'Desodorante',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => null,
                'category' => 'Batton',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('categories')->insert($categories);
    }
}
