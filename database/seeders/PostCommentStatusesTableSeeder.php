<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post\PostCommentStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostCommentStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $statuses = [
            ['name' => 'pending'],
            ['name' => 'approved'],
            ['name' => 'spam'],
            ['name' => 'deleted'],
        ];

        foreach ($statuses as $status) {
            PostCommentStatus::create($status);
        }

    }
}
