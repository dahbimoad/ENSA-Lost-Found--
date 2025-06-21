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
        // First, seed categories
        $this->call(CategorySeeder::class);
        
        // Verify categories were created
        $categoryCount = \App\Models\Category::count();
        $this->command->info("Categories created: {$categoryCount}");
        
        if ($categoryCount === 0) {
            $this->command->error("No categories were created! ItemSeeder will fail.");
            return;
        }

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

        // Verify users were created
        $userCount = \App\Models\User::count();
        $this->command->info("Users created: {$userCount}");

        // Seed items after users and categories are created
        $this->call(ItemSeeder::class);
    }
}
