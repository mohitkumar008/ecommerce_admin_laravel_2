<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productRecords = [
            [
                'category_id' => 1,
                'product_name' => 'Blue T-shirt',
                'product_url' => 'blue-t-shirt',
                'product_code' => 'MKP124',
                'product_color' => 'Black',
                'product_mrp' => 1500,
                'product_price' => 1299,
                'product_weight' => 0.300,
                'product_video' => '',
                'product_image' => '',
                'product_short_desc' => 'Test',
                'product_long_desc' => 'Test',
                'meta_title' => 'Test',
                'meta_desc' => 'Test',
                'meta_keyword' => 'Test',
                'is_featured' => 'Yes',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'product_name' => 'Black T-shirt',
                'product_url' => 'black-t-shirt',
                'product_code' => 'MKP126',
                'product_color' => 'Black',
                'product_mrp' => 1400,
                'product_price' => 1399,
                'product_weight' => 0.500,
                'product_video' => '',
                'product_image' => '',
                'product_short_desc' => 'Test',
                'product_long_desc' => 'Test',
                'meta_title' => 'Test',
                'meta_desc' => 'Test',
                'meta_keyword' => 'Test',
                'is_featured' => 'Yes',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        Product::insert($productRecords);
    }
}
