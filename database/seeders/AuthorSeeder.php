<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    \App\Models\Author::create([
        'name' => 'Kagawad Vince Ledesma',
        'position' => 'Kagawad',
        'email' => 'kagawad.ledesma@bulletin.test',
    ]);

    \App\Models\Author::factory()->count(4)->create();
    }
}
