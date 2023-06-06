<?php

namespace Database\Seeders;

use App\Models\PostCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'Recipes', 'slug' => 'recipes', 'description' => 'Food recipes written by DinnerWithRoberto', 'created_at' => '2023-06-02 15:17:04'],
            ['name' => 'Tips', 'slug' => 'tips', 'description' => 'Varoius tips or hacks in the kitchen', 'created_at' => '2023-06-02 15:17:04'],
            ['name' => 'Subscriber Recipes', 'slug' => 'subscriber-recipes', 'description' => 'Food recipes written by subscribers', 'created_at' => '2023-06-02 15:17:04'],
        ];

        foreach ($roles as $role) {
            PostCategory::create($role);
        }
    }
}
