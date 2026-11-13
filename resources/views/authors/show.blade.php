@extends('layouts.app')

@section('content')
    <div class="bg-white p-6 rounded shadow-md mb-8">
        <h2 class="text-2xl font-bold">{{ $author->name }}</h2>
        <p class="text-gray-600">{{ $author->position }}</p>
        <p class="text-gray-600 mt-2">Comments received: {{ $commentsReceived }}</p>
    </div>

    <h3 class="text-xl font-bold mb-4">Published posts</h3>
    <div class="space-y-4">
        @forelse($author->posts as $post)
            <article class="bg-white p-4 rounded shadow-md">
                <h4 class="text-lg font-bold">
                    <a href="{{ route('posts.show', $post->id) }}" class="text-blue-600 hover:underline">
                        {{ $post->title }}
                    </a>
                </h4>
                <p class="text-sm text-gray-500">{{ $post->published_at->format('M d, Y') }}</p>
            </article>
        @empty
            <p class="text-gray-600">No published posts yet.</p>
        @endforelse
    </div>
@endsection
