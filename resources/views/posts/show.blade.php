@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <a href="{{ route('posts.index') }}" class="text-blue-600 hover:underline mb-4 inline-block">&larr; Back to Bulletin</a>
    
    @if($post->is_pinned)
        <span class="bg-red-500 text-white text-xs px-2 py-1 rounded mb-4 inline-block ml-2">Pinned</span>
    @endif
    
    <h1 class="text-3xl font-bold mb-2">{{ $post->title }}</h1>
    
    <div class="text-sm text-gray-500 mb-6 border-b pb-4">
        <span class="bg-gray-200 text-gray-800 px-2 py-1 rounded">{{ $post->category }}</span> • 
        Published: {{ $post->published_at->format('F d, Y h:i A') }} • 
        Views: {{ $post->views }} • 
        Author ID: {{ $post->author_id }}
    </div>
    
    <div class="prose max-w-none text-gray-800 whitespace-pre-wrap">
        {{ $post->body }}
    </div>
</div>
@endsection