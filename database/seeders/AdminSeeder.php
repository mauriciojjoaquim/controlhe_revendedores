<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // admin
         DB::table('users')->insert([
            'department_id' => 1,
            'name' => 'Administrador',
            'document' => '176.1172.308-01',
            'email' => 'admin@rhmangnt.com',
            'email_verified_at' => now(),
            'password' => bcrypt('Abc123456'),
            'role' => 'admin',
            'permissions' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // RH
        DB::table('users')->insert([
            'department_id' => 2,
            'name' => 'Recursos Humanos',
            'document' => '176.1172.308-02',
            'email' => 'rh@rhmangnt.com',
            'email_verified_at' => now(),
            'password' => bcrypt('Abc123456'),
            'role' => 'rh',
            'permissions' => 'rh',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
         // Vendedora
         DB::table('users')->insert([
            'department_id' => 3,
            'name' => 'Vendedora',
            'document' => '176.1172.308-03',
            'email' => 'vendedora@rhmangnt.com',
            'email_verified_at' => now(),
            'password' => bcrypt('Abc123456'),
            'role' => 'vende',
            'permissions' => 'vende',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // Lider
        DB::table('users')->insert([
            'department_id' => 4,
            'name' => 'Liderança',
            'document' => '176.1172.308-04',
            'email' => 'lider@rhmangnt.com',
            'email_verified_at' => now(),
            'password' => bcrypt('Abc123456'),
            'role' => 'lider',
            'permissions' => 'lider',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // admin details
        DB::table('user_details')->insert([
            'user_id' => 1,
            'zip_code' => '1234-123',
            'address' => 'Rua do Administrador',
            'number' => 110,
            'complement' => 'sem',
            'neighborhood' => 'lisboa',
            'city' => 'Lisboa',
            'phone' => '900000001',
            'salary' => 0.00,
            'admission_date' => '2020-01-01',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // admin details
        DB::table('user_details')->insert([
            'user_id' => 2,
            'zip_code' => '1234-123',
            'address' => 'Rua do Administrador',
            'number' => 110,
            'complement' => 'sem',
            'neighborhood' => 'lisboa',
            'city' => 'Lisboa',
            'phone' => '900000001',
            'salary' => '0.00',
            'admission_date' => '2020-01-01',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // admin details
        DB::table('user_details')->insert([
            'user_id' => 3,
            'zip_code' => '1234-123',
            'address' => 'Rua do Administrador',
            'number' => 110,
            'complement' => 'sem',
            'neighborhood' => 'lisboa',
            'city' => 'Lisboa',
            'phone' => '900000001',
            'salary' => 0.00,
            'admission_date' => '2020-01-01',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // admin details
        DB::table('user_details')->insert([
            'user_id' => 4,
            'zip_code' => '1234-123',
            'address' => 'Rua do Administrador',
            'number' => 110,
            'complement' => 'sem',
            'neighborhood' => 'lisboa',
            'city' => 'Lisboa',
            'phone' => '900000001',
            'salary' => 0.00,
            'admission_date' => '2020-01-01',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        
        // Cliente order detalhe
        // DB::table('client_order_details')->insert([
        //     'user_id' => 1,
        //     'client_id'=> null,
        //     'user_id'=> 0.0,
        //     'total_price' => 0.0,
        //     'number_of_installments'=> 0.0,
        //     'price_per_installment',
        //     'installments_paid' => 0,
        //     'installment_due_date' => now(),
        //     'installment_payment_date'=> 0,
        //     'customer_status' => 'NC',
        //     'situation' => 'liberado',
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);


        

        // admin department
        DB::table('departments')->insert([
            'name' => 'Administração',
            'short_name'=> 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // rh department
        DB::table('departments')->insert([
            'name' => 'Recursos Humanos',
            'short_name'=> 'rh',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Vendedora department
        DB::table('departments')->insert([
            'name' => 'Vendedora',
            'short_name'=> 'vende',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // lider department
        DB::table('departments')->insert([
            'name' => 'Liderança',
            'short_name'=> 'lider',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

         // client department
         DB::table('departments')->insert([
            'name' => 'Cliente',
            'short_name'=> 'client',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // settings_details
        DB::table('settings_details')->insert([
            'user_id' => 1,
            'cor_id' => 2,
            'pix' => 'sem',
            'percentage' => 30,
            'installment_number' => 1,
            'price' => '0.00',
            'minimum_price_for_installment' => 0.00,
            'text_color_site' => 'text-dark',
            'text_color' => 'text-dark',
            'color_site_bg' => 'bg-primary',
            'bg_color_site' => 'bg-primary',
            'bg_color_menu' => 'bg-primary',
            'color_menu_vertical_text' => 'text-dark',
            'bg_color_table' => 'table-primary',
            'color_table_text' => 'text-dark',
            'color_card_bg' => 'bg-primary',
            'color_card_text' => 'text-dark',
            'color_border' => 'border-primary',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        DB::table('settings_details')->insert([
            'user_id' => 2,
            'cor_id' => 2,
            'pix' => 'sem',
            'percentage' => 30,
            'installment_number' => 1,
            'price' => '0.00',
            'minimum_price_for_installment' => 0.00,
            'text_color_site' => 'text-dark',
            'text_color' => 'text-dark',
            'color_site_bg' => 'bg-primary',
            'bg_color_site' => 'bg-primary',
            'bg_color_menu' => 'bg-primary',
            'color_menu_vertical_text' => 'text-dark',
            'bg_color_table' => 'table-primary',
            'color_table_text' => 'text-dark',
            'color_card_bg' => 'bg-primary',
            'color_card_text' => 'text-dark',
            'color_border' => 'border-primary',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('settings_details')->insert([
            'user_id' => 3,
            'cor_id' => 2,
            'pix' => 'sem',
            'percentage' => 30,
            'installment_number' => 1,
            'price' => '0.00',
            'minimum_price_for_installment' => 0.00,
            'text_color_site' => 'text-dark',
            'text_color' => 'text-dark',
            'color_site_bg' => 'bg-primary',
            'bg_color_site' => 'bg-primary',
            'bg_color_menu' => 'bg-primary',
            'color_menu_vertical_text' => 'text-dark',
            'bg_color_table' => 'table-primary',
            'color_table_text' => 'text-dark',
            'color_card_bg' => 'bg-primary',
            'color_card_text' => 'text-dark',
            'color_border' => 'border-primary',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('settings_details')->insert([
            'user_id' => 4,
            'cor_id' => 2,
            'pix' => 'sem',
            'percentage' => 30,
            'installment_number' => 1,
            'price' => '0.00',
            'minimum_price_for_installment' => 0.00,
            'text_color_site' => 'text-dark',
            'text_color' => 'text-dark',
            'color_site_bg' => 'bg-primary',
            'bg_color_site' => 'bg-primary',
            'bg_color_menu' => 'bg-primary',
            'color_menu_vertical_text' => 'text-dark',
            'bg_color_table' => 'table-primary',
            'color_table_text' => 'text-dark',
            'color_card_bg' => 'bg-primary',
            'color_card_text' => 'text-dark',
            'color_border' => 'border-primary',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        


    }
}