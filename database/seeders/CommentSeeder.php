<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $publishedPosts = Post::whereNotNull('published_at')->get();
        $users = User::all();
        $lola = User::where('email', 'lola.ledesma@bulletin.test')->first();

        foreach ($publishedPosts as $post) {
            if ($post->is_pinned) {
                Comment::factory()->create(['post_id' => $post->id, 'user_id' => $lola->id]);
                Comment::factory(2)->create(['post_id' => $post->id, 'user_id' => $users->random()->id]);
            } else {
                $numComments = rand(0, 5);
                for ($i = 0; $i < $numComments; $i++) {
                    Comment::factory()->create(['post_id' => $post->id, 'user_id' => $users->random()->id]);
                }
            }
        }
    }
}