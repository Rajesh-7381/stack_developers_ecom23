<?php

namespace Database\Seeders;

use App\Models\Cupon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CuponTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $cuponRecords = [
            [
                'id' => 1,
                'cupon_option' => 'percentage',
                'cupon_code' => 'CUPON123',
                'categories' => 'Electronics',
                'brands' => 'Sony, Samsung',
                // 'users' => '',
                'cupon_type' => 'flat',
                // 'amount_type' => 'percentage',
                'amount' => 20.5,
                'expiary_date' => '2024-12-31',
                'status' => 1,
            ],
            [
                'id' => 2,
                'cupon_option' => 'percentage',
                'cupon_code' => 'CUPON123',
                'categories' => 't-Shirt',
                'brands' => 'jockey',
                // 'users' => 'raheshkumar73812@gmail.com',
                'cupon_type' => 'flat',
                // 'amount_type' => 'percentage',
                'amount' => 200.5,
                'expiary_date' => '2024-12-31',
                'status' => 1,
            ], // No comma here after the last element
        ];
        Cupon::insert($cuponRecords);
        
    }
}
