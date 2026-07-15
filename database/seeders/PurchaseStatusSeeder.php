<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchaseStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $purchaseStatus = [
            [
                'status' => 'Pagamento efetuado', 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'status' => 'Aguardando Fechamento', 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'status' => 'Falha no Fechamento', 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'status' => 'Aguardando Pagamento', 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'status' => 'Cancelamento', 
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('purchase_status')->insert($purchaseStatus);
    }
}