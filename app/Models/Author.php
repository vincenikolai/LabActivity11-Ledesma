<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Author extends Model
{
    use HasFactory;

    // --- UPDATE YOUR FILLABLE ARRAY HERE ---
    protected $fillable = ['name', 'position', 'email', 'user_id'];

    // --- ADD YOUR NEW METHODS HERE ---
    public function user() { 
        return $this->belongsTo(User::class); 
    }

    public function posts() { 
        return $this->hasMany(Post::class); 
    }

    public function comments() { 
        return $this->hasManyThrough(Comment::class, Post::class); 
    }
}