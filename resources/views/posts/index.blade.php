@extends('layouts.app')

@section('content')
<form method="GET" action="{{ route('posts.index') }}" class="flex flex-col sm:flex-row gap-2 mb-6">
    <input type="text" name="q" value="{{ request('q') }}" placeholder="Search title" class="border p-2 rounded w-full sm:w-auto">
    <select name="category" class="border p-2 rounded">
        <option value="">All Categories</option>
        @foreach ($categories as $c)
            <option value="{{ $c }}" {{ request('category') == $c ? 'selected' : '' }}>{{ $c }}</option>
        @endforeach
    </select>
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Filter</button>
</form>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
    @forelse ($posts as $post)
        <div class="border p-4 rounded bg-white shadow">
            @if($post->is_pinned)
                <span class="bg-red-500 text-white text-xs px-2 py-1 rounded mb-2 inline-block">Pinned</span>
            @endif
            <h2 class="text-xl font-bold">
                <a href="{{ route('posts.show', $post->id) }}" class="text-blue-600 hover:underline">{{ $post->title }}</a>
            </h2>
            <div class="text-sm text-gray-500 mt-1 mb-2">
                <span class="bg-gray-200 px-2 py-1 rounded text-xs">{{ $post->category }}</span> • 
                {{ $post->published_at->format('M d, Y') }} • 
                {{ $post->views }} views
            </div>
            <p class="text-gray-700">{{ Str::limit($post->body, 100) }}</p>
            <p class="text-xs text-gray-400 mt-2">Author ID: {{ $post->author_id }}</p>
        </div>
    @empty
        <p class="col-span-full text-center text-gray-500">No posts match your search.</p>
    @endforelse
</div>

<div class="mb-4">
    {{ $posts->links() }}
</div>
<p class="text-sm text-gray-500 text-center mb-10">
    Showing {{ $posts->firstItem() }}-{{ $posts->lastItem() }} of {{ $posts->total() }} posts
</p>
@endsection