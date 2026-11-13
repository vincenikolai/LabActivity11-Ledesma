<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::whereNotNull('published_at')
            ->with(['author', 'tags']) 
            ->withCount('comments')    
            ->orderBy('is_pinned', 'desc')
            ->latest('published_at');

        if ($request->has('tag')) {
            $query->whereHas('tags', function($q) use ($request) {
                $q->where('name', $request->tag);
            });
        }

        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('body', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->has('category') && $request->category !== '') {
            $query->where('category', $request->category);
        }
        
        $posts = $query->paginate(10)->withQueryString();
        return view('posts.index', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        $post->increment('views');
        
        $post->load(['author', 'tags', 'comments.user']); 
        
        $comments = $post->comments->sortByDesc('created_at'); 
        return view('posts.show', compact('post', 'comments'));
    }

    public function create()
    {
        $tags = Tag::all();
        return view('posts.create', compact('tags'));
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->safe()->except('tags');
        if ($request->has('is_published')) {
            $data['published_at'] = now();
        }

        $post = auth()->user()->author->posts()->create($data);
        $post->tags()->sync($request->validated('tags'));

        return redirect()->route('posts.index')->with('status', 'Post created successfully.');
    }
}