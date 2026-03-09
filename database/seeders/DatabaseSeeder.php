<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // إنشاء حساب admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        // استدعاء seeders الأخرى
        $this->call([
            WilayaSeeder::class,
            ProductSeeder::class,
        ]);
    }
}