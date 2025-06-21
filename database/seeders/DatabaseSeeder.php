<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CategorySeeder::class,
        ]);

        // Create a test admin user
        \App\Models\User::firstOrCreate(
            ['email' => 'admin@ensa.ma'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );

        // Create a test regular user
        \App\Models\User::firstOrCreate(
            ['email' => 'test@ensa.ma'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
                'student_id' => 'E12345',
                'email_verified_at' => now(),
            ]
        );

        // Create some additional users for items
        \App\Models\User::factory(8)->create();

        // Seed items after users are created
        $this->call([
            ItemSeeder::class,
        ]);
    }
}
