<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductAttr;

class ProductAttrTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productAttrRecords = [
            [
                'pid' => 1,
                'size' => 'Small',
                'price' => 123,
                'stock' => 25,
                'sku' => 'MKP124-S',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pid' => 1,
                'size' => 'Medium',
                'price' => 153,
                'stock' => 25,
                'sku' => 'MKP124-M',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pid' => 1,
                'size' => 'Large',
                'price' => 193,
                'stock' => 20,
                'sku' => 'MKP124-L',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        ProductAttr::insert($productAttrRecords);
    }
}
