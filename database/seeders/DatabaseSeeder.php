<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            "name" => "Administrator",
            "email" => "admin@inforkomwec.com",
            "email_verified_at" => date("Y-m-d h:i:s"),
            "password" => Hash::make('admin'),
            "role" => "superadmin",
            "status" => 1
        ]);
    }
}
