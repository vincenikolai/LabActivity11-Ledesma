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
            ->orderByDesc('is_pinned')
            ->latest('published_at');

        if ($request->has('tag')) {
            $query->whereHas('tags', function($q) use ($request) {
                $q->where('name', $request->tag);
            });
        }

        if ($request->has('q')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->q . '%')
                  ->orWhere('body', 'like', '%' . $request->q . '%');
            });
        }

        if ($request->has('category') && $request->category !== '') {
            $query->where('category', $request->category);
        }
        
        $posts = $query->paginate(7)->withQueryString();
        $categories = Post::query()->distinct()->orderBy('category')->pluck('category');

        return view('posts.index', compact('posts', 'categories'));
    }

    public function show($id)
    {
        $post = Post::whereNotNull('published_at')->findOrFail($id);
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
        if ($request->boolean('is_published')) {
            $post->published_at = now();
            $post->save();
        }
        $post->tags()->sync($request->validated('tags'));

        return redirect()->route('posts.index')->with('status', 'Post created successfully.');
    }
}