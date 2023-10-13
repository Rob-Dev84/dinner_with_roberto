<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post\PostRecipeCookingMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostCookingMethodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cookingMethods = [
            ['name' => 'Oven', 'created_at' => '2023-06-02 15:17:04'],
            ['name' => 'Hob', 'created_at' => '2023-06-02 15:17:04'],
            ['name' => 'Microwave', 'created_at' => '2023-06-02 15:17:04'],
            ['name' => 'Hob/Refrigerator', 'created_at' => '2023-06-02 15:17:04'],
            ['name' => 'Freeze', 'created_at' => '2023-06-02 15:17:04'],
            ['name' => 'Refrigerator', 'created_at' => '2023-06-02 15:17:04'],
            ['name' => 'Subscriber', 'created_at' => '2023-06-02 15:17:04'],
            ['name' => 'Stir', 'created_at' => '2023-06-02 15:17:04'],
            ['name' => 'Stand Mixer', 'created_at' => '2023-06-02 15:17:04'],
            ['name' => 'Hand Mixer', 'created_at' => '2023-06-02 15:17:04'],
        ];

        foreach ($cookingMethods as $cookingMethod) {
            PostRecipeCookingMethod::create($cookingMethod);
        }
    }
}
