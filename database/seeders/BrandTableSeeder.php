<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brandRecords = [
            [
                'name' => 'Arrow',
                'slug' => 'arrow',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Nikaa',
                'slug' => 'nikaa',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'The Weird Man',
                'slug' => 'twm',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'OyeGlow',
                'slug' => 'oyeglow',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        Brand::insert($brandRecords);
    }
}
