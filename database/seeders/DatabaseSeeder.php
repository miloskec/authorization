<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'username' => 'admin',
            'full_name' => 'Microservice Admin',
            'email' => 'miloskecman@gmail.com',
        ]);
        User::factory()->create([
            'username' => 'user',
            'full_name' => 'Microservice User',
            'email' => 'miloskeckecman@gmail.com',
        ]);
        User::factory(8)->create();

        $this->call(RoleSeeder::class);
    }
}
