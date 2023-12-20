<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.br',
            'password' => Hash::make('123456789'),
            'cpf' => '12345678910',
            'access_level' => 2
        ]);

        \App\Models\Organization::factory()->createMany([
            [
                "name" => 'education_secretary'
            ],
            [
                "name" => 'health_secretary'
            ],
            [
                "name" => 'security_secretary'
            ],
            [
                "name" => 'traffic_secretary'
            ]
        ]);
    }
}
