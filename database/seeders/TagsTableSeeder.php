<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            //Main course
            ['name' => 'Pasta', 'slug' => 'pasta', 'created_at' => '2023-06-02 15:17:04'],
            ['name' => 'Rice', 'slug' => 'rice', 'created_at' => '2023-06-02 15:17:04'],
            ['name' => 'Chicken', 'slug' => 'chicken', 'created_at' => '2023-06-02 15:17:04'],
            ['name' => 'Beef', 'slug' => 'beef', 'created_at' => '2023-06-02 15:17:04'],
            ['name' => 'Seafood', 'slug' => 'seafood', 'created_at' => '2023-06-02 15:17:04'],
            ['name' => 'Grilled', 'slug' => 'grilled', 'created_at' => '2023-06-02 15:17:04'],
            
            
            //Pizza Bread
            ['name' => 'Pizza', 'slug' => 'pizza', 'created_at' => '2023-06-02 15:17:04'],
            ['name' => 'Bread', 'slug' => 'bread', 'created_at' => '2023-06-02 15:17:04'],
            ['name' => 'Neapolitan', 'slug' => 'neapolitan', 'created_at' => '2023-06-02 15:17:04'],
            ['name' => 'Focaccia', 'slug' => 'focaccia', 'created_at' => '2023-06-02 15:17:04'],
            // ['name' => 'Pepperoni', 'slug' => 'pepperoni', 'created_at' => '2023-06-02 15:17:04'],
            // ['name' => 'Mushroom', 'slug' => 'mushroom', 'created_at' => '2023-06-02 15:17:04'],
            ['name' => 'Cheese', 'slug' => 'cheese', 'created_at' => '2023-06-02 15:17:04'],
            ['name' => 'Ham', 'slug' => 'ham', 'created_at' => '2023-06-02 15:17:04'],
            // ['name' => 'Thin Crust', 'slug' => 'thin-crust', 'created_at' => '2023-06-02 15:17:04'],

            //Snacks
            ['name' => 'Quick Snacks', 'slug' => 'quick-snacks', 'created_at' => '2023-06-02 15:17:04'],
            ['name' => 'Appetizers', 'slug' => 'appetizers', 'created_at' => '2023-06-02 15:17:04'],
            ['name' => 'Finger Foods', 'slug' => 'finger-foods', 'created_at' => '2023-06-02 15:17:04'],
            ['name' => 'Party Snacks', 'slug' => 'party-snacks', 'created_at' => '2023-06-02 15:17:04'],

            //Cakes
            ['name' => 'Chocolate', 'slug' => 'chocolate', 'created_at' => '2023-06-02 15:17:04'],
            ['name' => 'Vanilla', 'slug' => 'vanilla', 'created_at' => '2023-06-02 15:17:04'],
            ['name' => 'Fruit', 'slug' => 'fruit', 'created_at' => '2023-06-02 15:17:04'],
            ['name' => 'Layered', 'slug' => 'layered', 'created_at' => '2023-06-02 15:17:04'],
            ['name' => 'Frosting', 'slug' => 'frosting', 'created_at' => '2023-06-02 15:17:04'],
            ['name' => 'Yeast Bakery', 'slug' => 'yeast-bakery', 'created_at' => '2023-06-02 15:17:04'],
            ['name' => 'Celebration Cakes', 'slug' => 'celebration-cakes', 'created_at' => '2023-06-02 15:17:04'],
            ['name' => 'No Baked', 'slug' => 'no-baked', 'created_at' => '2023-06-02 15:17:04'],

            //Cross category (in this case subcategory)
            ['name' => 'Neapolitan Food', 'slug' => 'neapolitan-food', 'created_at' => '2023-06-02 15:17:04'],
            ['name' => 'Vegetarian', 'slug' => 'vegetarian', 'created_at' => '2023-06-02 15:17:04'],
            ['name' => 'Vegan', 'slug' => 'vegan', 'created_at' => '2023-06-02 15:17:04'],
            ['name' => 'Healthy', 'slug' => 'healthy', 'created_at' => '2023-06-02 15:17:04'],


          
        ];

        foreach ($roles as $role) {
            Tag::create($role);
        }
    }
}
