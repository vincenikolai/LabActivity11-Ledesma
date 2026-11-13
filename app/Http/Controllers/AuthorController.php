<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author; 

class AuthorController extends Controller
{ 

    public function show(Author $author)
    {
        $author->load(['posts' => function($q) {
            $q->whereNotNull('published_at')->latest('published_at');
        }]);
        
        // hasManyThrough count
        $commentsReceived = $author->comments()->count(); 
        
        return view('authors.show', compact('author', 'commentsReceived'));
    }

} 