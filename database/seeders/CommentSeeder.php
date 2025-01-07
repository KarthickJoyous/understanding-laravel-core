<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Media;
use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::inRandomOrder()->first();

        Comment::factory(1)
            ->for(Post::factory()->for($user)->has(Media::factory()->count(rand(0, 5))))
            ->for($user)
            ->has(Media::factory()->count(rand(0, 5)))
            ->create();
    }
}
