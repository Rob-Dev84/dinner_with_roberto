<?php

namespace Database\Seeders;

use App\Models\PostSubcategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSubcategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'Main Courses', 'slug' => 'subscriber-recipes', 'description' => 'Main course recipes', 'created_at' => '2023-06-02 15:17:04'],
            ['name' => 'Pazza Breads', 'slug' => 'pizza-breads', 'description' => 'Recipes for pizza and bread', 'created_at' => '2023-06-02 15:17:04'],
            ['name' => 'Snacks', 'slug' => 'snaks', 'description' => 'Recipes for snaks or picnic food', 'created_at' => '2023-06-02 15:17:04'],
            ['name' => 'Cakes', 'slug' => 'cakes', 'description' => 'Recipes for cakes and deserts', 'created_at' => '2023-06-02 15:17:04'],
        ];

        foreach ($roles as $role) {
            PostSubcategory::create($role);
        }
    }
}
