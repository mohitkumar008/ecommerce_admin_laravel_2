<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CateogryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryRecords = [
            [
                'parent_id' => 0,
                'section_id' => 1,
                'category_name' => 'T-Shirts',
                'category_image' => '',
                'category_discount' => 0,
                'description' => '',
                'url' => 't-shirts',
                'meta_title' => '',
                'meta_desc' => '',
                'meta_keyword' => '',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'parent_id' => 1,
                'section_id' => 1,
                'category_name' => 'Casual T-Shirts',
                'category_image' => '',
                'category_discount' => 0,
                'description' => '',
                'url' => 'casual-t-shirts',
                'meta_title' => '',
                'meta_desc' => '',
                'meta_keyword' => '',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        Category::insert($categoryRecords);
    }
}
