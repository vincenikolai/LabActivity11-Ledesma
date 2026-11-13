<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    public const CATEGORIES = ['Announcement', 'Event', 'Missing', 'Found', 'Other', 'Sports'];

    protected $fillable = ['title', 'body', 'category', 'author_id'];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'is_pinned' => 'boolean',
        ];
    }

    // --- ADD YOUR NEW METHODS HERE ---
    public function author() { 
        return $this->belongsTo(Author::class, 'author_id'); 
    }

    public function comments() { 
        return $this->hasMany(Comment::class); 
    }

    public function tags() { 
        return $this->belongsToMany(Tag::class); 
    }
}