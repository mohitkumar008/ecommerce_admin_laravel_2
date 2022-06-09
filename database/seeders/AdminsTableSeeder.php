<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRecords = [
            'name' => 'Mohit Kumar', 'type' => 'admin', 'mobile' => '9899199392', 'email' => 'admin@gmail.com', 'password' => Hash::make('123456'), 'image' => '', 'status' => 1
        ];
        Admin::create($adminRecords);
    }
}
