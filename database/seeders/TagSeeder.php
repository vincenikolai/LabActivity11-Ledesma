<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;
use App\Models\Post;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = collect([
            Tag::create(['name' => 'Purok Ledesma']),
            Tag::create(['name' => 'Urgent']),
            Tag::create(['name' => 'Libre']),
            Tag::create(['name' => 'Schedule']),
            Tag::create(['name' => 'Ayuda']), // Your 5th custom tag
        ]);

        $posts = Post::all();
        foreach ($posts as $post) {
            if ($post->is_pinned) {
                $post->tags()->sync([
                    $tags->where('name', 'Purok Ledesma')->first()->id,
                    $tags->where('name', 'Urgent')->first()->id,
                ]);
            } else {
                $post->tags()->attach($tags->random(rand(1, 3))->pluck('id'));
            }
        }
    }
}