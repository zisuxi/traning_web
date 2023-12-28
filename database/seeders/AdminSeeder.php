<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        user::create([
            'user_name' => "admin",
            "email" => "itsme.talha64@gmail.com",
            "password" => bcrypt(123456),
            "Is_admin" => 1,
            "Is_active" => 1,
        ]);
    }
}
