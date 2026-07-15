<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccessesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('accesses')->insert([
            'name'=> 'Administração',
            'short_name'=> 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('accesses')->insert([
            'name'=> 'Recursos Humanos',
            'short_name'=> 'rh',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('accesses')->insert([
            'name'=> 'Liderança',
            'short_name'=> 'lider',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('accesses')->insert([
            'name'=> 'Vendedoras',
            'short_name'=> 'vende',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
            DB::table('accesses')->insert([
                'name'=> 'Clientes',
                'short_name'=> 'client',
                'created_at' => now(),
                'updated_at' => now(),
        ]);
    }
}