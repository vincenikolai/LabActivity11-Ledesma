<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Author;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Lola Ledesma',
            'email' => 'lola.ledesma@bulletin.test',
            'password' => Hash::make('bulletin2026'),
        ]);

        $kagawadUser = User::create([
            'name' => 'Kagawad Ledesma',
            'email' => 'kagawad.ledesma@bulletin.test',
            'password' => Hash::make('bulletin2026'),
        ]);

        $author = Author::where('email', 'kagawad.ledesma@bulletin.test')->first();
        if ($author) {
            $author->update(['user_id' => $kagawadUser->id]);
        }

        User::factory(8)->create();
    }
}