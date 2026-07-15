<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CorBootstrapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $boots = [
            ['name' => 'Primary', 'color_bg' => 'bg-primary', 'color_table_bg' => 'table-primary', 'color_card_bg' => 'bg-primary', 'color_text' => 'text-primary', 'color_border' => 'border-primary'],
            ['name' => 'Secondary', 'color_bg' => 'bg-secondary', 'color_table_bg' => 'table-bg-secondary', 'color_card_bg' => 'bg-secondary', 'color_text' => 'text-secondary', 'color_border' => 'border-secondary'],
            ['name' => 'Success', 'color_bg' => 'bg-success', 'color_table_bg' => 'table-success', 'color_card_bg' => 'bg-success', 'color_text' => 'text-success', 'color_border' => 'border-success'],
            ['name' => 'Info', 'color_bg' => 'bg-info', 'color_table_bg' => 'table-info', 'color_card_bg' => 'bg-info', 'color_text' => 'text-info', 'color_border' => 'border-info'],
            ['name' => 'Warning', 'color_bg' => 'bg-warning', 'color_table_bg' => 'table-warning', 'color_card_bg' => 'bg-warning', 'color_text' => 'text-warning', 'color_border' => 'border-warning'],
            ['name' => 'Danger', 'color_bg' => 'bg-danger', 'color_table_bg' => 'table-danger', 'color_card_bg' => 'bg-danger', 'color_text' => 'text-danger', 'color_border' => 'border-danger'],
            ['name' => 'Light', 'color_bg' => 'bg-light', 'color_table_bg' => 'table-light', 'color_card_bg' => 'bg-light', 'color_text' => 'text-light', 'color_border' => 'border-light'],
            ['name' => 'Dark', 'color_bg' => 'bg-dark', 'color_table_bg' => 'table-dark', 'color_card_bg' => 'bg-dark', 'color_text' => 'text-dark', 'color_border' => 'border-dark'],
        ];
        
        DB::table('cor_bootstraps')->insert($boots);
    }
}


/**
primary
secondary
success
info
warning
danger
light
dark
 */