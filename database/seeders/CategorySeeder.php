<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Electronics',
                'icon' => '📱',
                'description' => 'Mobile phones, laptops, tablets, headphones, etc.'
            ],
            [
                'name' => 'Books',
                'icon' => '📚',
                'description' => 'Textbooks, notebooks, documents'
            ],
            [
                'name' => 'Clothing',
                'icon' => '👔',
                'description' => 'Jackets, bags, shoes, accessories'
            ],
            [
                'name' => 'Accessories',
                'icon' => '⌚',
                'description' => 'Watches, jewelry, keys, wallets'
            ],
            [
                'name' => 'Documents',
                'icon' => '📄',
                'description' => 'ID cards, certificates, important papers'
            ],
            [
                'name' => 'Other',
                'icon' => '📦',
                'description' => 'Items that don\'t fit other categories'
            ]
        ];

        foreach ($categories as $category) {
            $createdCategory = Category::firstOrCreate(
                ['name' => $category['name']],
                $category
            );
            $this->command->info("Category created/found: {$createdCategory->name}");
        }
        
        $this->command->info("Total categories in database: " . Category::count());
    }
}
