<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\Roles;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::factory()->create([
            'name' => Roles::OPERATOR->title(),
            'code' => Roles::OPERATOR->value,
        ]);

        Role::factory()->create([
            'name' => Roles::ENGINEER->title(),
            'code' => Roles::ENGINEER->value,
        ]);

        Role::factory()->create([
            'name' => Roles::ADMIN->title(),
            'code' => Roles::ADMIN->value,
        ]);

        Role::factory()->create([
            'name' => Roles::GUEST->title(),
            'code' => Roles::GUEST->value,
        ]);

         \App\Models\User::factory()->create([
             'name' => 'Test Operator',
                 'email' => 'operator@test.com',
             'password' => Hash::make('password'),
             'role_id' => 1,
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test Engineer',
            'email' => 'engineer@test.com',
            'password' => Hash::make('password'),
            'role_id' => 2,
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
            'role_id' => 3,
        ]);
    }
}
