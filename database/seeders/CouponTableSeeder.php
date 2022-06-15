<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Coupon;

class CouponTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $couponRecords = [
            [
                'title' => 'Get 10% Off',
                'code' => 'GET10',
                'discount' => 10,
                'type' => 'Per',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Flat Rs200 Off',
                'code' => 'FLAT200',
                'discount' => 200,
                'type' => 'Val',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Bumper 80% Off',
                'code' => 'BUMPER80',
                'discount' => 80,
                'type' => 'Per',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        Coupon::insert($couponRecords);
    }
}
