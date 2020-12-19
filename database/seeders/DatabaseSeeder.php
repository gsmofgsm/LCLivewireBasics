<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
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
         User::factory(30)->create();
         $posts = Post::factory(3)->create();
         $posts->each(function($post) {
             Comment::factory(4)->create(['post_id' => $post->id]);
         });
    }
}
