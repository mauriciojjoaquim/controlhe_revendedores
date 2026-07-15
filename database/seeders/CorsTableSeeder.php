<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cors = [
            ['cor_name_br' => 'Cardo', 'cor_tag' => 'thistle', 'text_cor'=> 'text-dark', 'created_at' => now()],
            ['cor_name_br' => 'Ciano Claro', 'cor_tag' => 'lightcyan', 'text_cor'=> 'text-dark', 'created_at' => now()],
            ['cor_name_br' => 'Mocassim', 'cor_tag' => 'moccasin', 'text_cor'=> 'text-dark', 'created_at' => now()],
            ['cor_name_br' => 'Cáqui', 'cor_tag' => 'khaki', 'text_cor'=>'text-dark', 'created_at' => now()],
            ['cor_name_br' => 'Laranja', 'cor_tag' => 'orange', 'text_cor'=> 'text-dark', 'created_at' => now()],
            ['cor_name_br' => 'Roxo', 'cor_tag' => 'purple', 'text_cor'=> 'text-lithg', 'created_at' => now()],
            ['cor_name_br' => 'Magenta Escuro', 'cor_tag' => 'darkmagenta', 'text_cor'=> 'text-lithg', 'created_at' => now()],
            ['cor_name_br' => 'Bege', 'cor_tag' => 'tan', 'text_cor'=> 'text-dark', 'created_at' => now()],
            ['cor_name_br' => 'Azul-ardósia', 'cor_tag' => 'mediumslateblue', 'text_cor'=> 'text-dark', 'created_at' => now()],
            ['cor_name_br' => 'Roxo Médio', 'cor_tag' => 'mediumpurple', 'text_cor'=> 'text-dark', 'created_at' => now()],
            ['cor_name_br' => 'Marrom-rosado', 'cor_tag' => 'rosybrown', 'text_cor'=> 'text-dark', 'created_at' => now()],
            ['cor_name_br' => 'Peru', 'cor_tag' => 'peru', 'text_cor'=> 'text-dark', 'created_at' => now()],
            ['cor_name_br' => 'Chocolate', 'cor_tag' => 'chocolate', 'text_cor'=> 'text-dark', 'created_at' => now()],
            ['cor_name_br' => 'Marrom-areia', 'cor_tag' => 'sandybrown', 'text_cor'=> 'text-dark', 'created_at' => now()],
            ['cor_name_br' => 'Verde-floresta', 'cor_tag' => 'forestgreen', 'text_cor'=> 'text-dark', 'created_at' => now()],
            ['cor_name_br' => 'Verde-limão', 'cor_tag' => 'limegreen', 'text_cor'=> 'text-dark', 'created_at' => now()],
            ['cor_name_br' => 'Limão', 'cor_tag' => 'lime', 'text_cor'=> 'text-dark', 'created_at' => now()],
            ['cor_name_br' => 'Turquesa', 'cor_tag' => 'turquoise', 'text_cor'=> 'text-dark', 'created_at' => now()],
            ['cor_name_br' => 'médio', 'cor_tag' => 'mediumturquoise', 'text_cor'=> 'text-dark', 'created_at' => now()],
            ['cor_name_br' => 'Verde-marinho-claro', 'cor_tag' => 'lightseagreen', 'text_cor'=> 'text-dark', 'created_at' => now()],
            ['cor_name_br' => 'Ciano-escuro', 'cor_tag' => 'darkcyan', 'text_cor'=> 'text-dark', 'created_at' => now()],
            ['cor_name_br' => 'Marinho', 'cor_tag' => 'navy', 'text_cor'=> 'text-lithg', 'created_at' => now()],
            ['cor_name_br' => 'Azul Escuro', 'cor_tag' => 'darkblue', 'text_cor'=> 'text-lithg', 'created_at' => now()],
            ['cor_name_br' => 'Azul Médio', 'cor_tag' => 'mediumblue', 'text_cor'=> 'text-lithg', 'created_at' => now()],
            ['cor_name_br' => 'Preto', 'cor_tag' => 'bg-black', 'text_cor'=> 'text-lithg', 'created_at' => now()],
            ['cor_name_br' => 'Azul', 'cor_tag' => 'blue', 'text_cor'=> 'text-lithg', 'created_at' => now()],
            ['cor_name_br' => 'cinza11', 'cor_tag' => 'grey11', 'text_cor'=> 'text-lithg', 'created_at' => now()],
            ['cor_name_br' => 'cinza21', 'cor_tag' => 'grey21', 'text_cor'=> 'text-lithg', 'created_at' => now()],
            ['cor_name_br' => 'cinza31', 'cor_tag' => 'grey31', 'text_cor'=> 'text-lithg', 'created_at' => now()],
            ['cor_name_br' => 'Cinza Escuro', 'cor_tag' => 'dimgray', 'text_cor'=> 'text-lithg', 'created_at' => now()],
            ['cor_name_br' => 'Cinza', 'cor_tag' => 'gray', 'text_cor'=> 'text-lithg', 'created_at' => now()],
        ];
        DB::table('cors')->insert($cors);
    }
}
