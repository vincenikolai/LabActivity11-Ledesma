<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $authors = \App\Models\Author::all();
    $myKagawad = \App\Models\Author::where('email', 'kagawad.ledesma@bulletin.test')->first();

    \App\Models\Post::factory()->count(40)
        ->sequence(fn ($seq) => ['author_id' => $authors->random()->id])
        ->create();

    \App\Models\Post::factory()->count(10)->draft()
        ->sequence(fn ($seq) => ['author_id' => $authors->random()->id])
        ->create();

    $pinnedPost = \App\Models\Post::create([
        'author_id' => $myKagawad->id,
        'title' => 'Purok Ledesma Clean-up Drive',
        'category' => 'Announcement',
        'body' => 'Please join our clean-up drive!',
    ]);
    $pinnedPost->published_at = '2004-09-14 08:00:00';
    $pinnedPost->is_pinned = true;
    $pinnedPost->save();
}
}
