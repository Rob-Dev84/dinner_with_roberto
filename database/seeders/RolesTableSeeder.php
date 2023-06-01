<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'Subscriber', 'description' => 'Subscriber role description'],
            ['name' => 'Contributor', 'description' => 'Contributor role description'],
            ['name' => 'Author', 'description' => 'Author role description'],
            ['name' => 'Editor', 'description' => 'Editor role description'],
            ['name' => 'Admin', 'description' => 'Admin role description'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
