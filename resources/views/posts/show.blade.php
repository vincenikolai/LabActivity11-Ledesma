<x-layout>
    <div class="max-w-4xl mx-auto p-6 mt-10">
        
        <!-- Post Details -->
        <div class="bg-white p-6 rounded shadow-md mb-8">
            <h1 class="text-3xl font-bold mb-2">
                @if($post->is_pinned) 📌 @endif
                {{ $post->title }}
            </h1>
            <p class="text-gray-600 mb-4">
                By {{ $post->author->user->name }} | Views: {{ $post->views }} | Category: {{ $post->category }}
            </p>
            
            <div class="mb-4 flex gap-2">
                @foreach($post->tags as $tag)
                    <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">{{ $tag->name }}</span>
                @endforeach
            </div>

            <div class="text-lg mb-6">
                {{ $post->body }}
            </div>
        </div>

        <!-- Comments Section -->
        <div class="bg-gray-50 p-6 rounded shadow-md">
            <h2 class="text-2xl font-bold mb-4">Comments ({{ $comments->count() }})</h2>

            <!-- Authentication Wrapper for Comment Form -->
            @auth
                <form action="{{ route('comments.store', $post->id) }}" method="POST" class="mb-8">
                    @csrf
                    <div class="mb-4">
                        <label for="body" class="block font-bold mb-2">Leave a Comment</label>
                        <textarea name="body" id="body" rows="3" 
                            class="w-full border rounded p-2 focus:outline-blue-500" 
                            placeholder="Write your comment here...">{{ old('body') }}</textarea>
                        
                        <!-- Comment Error Handling -->
                        @error('body')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Post Comment
                    </button>
                </form>
            @else
                <p class="text-gray-600 italic mb-8 border-l-4 border-gray-400 pl-4 py-2">
                    Sign in to comment
                </p>
            @endauth

            <!-- Display Comments -->
            <div class="space-y-4">
                @forelse($comments as $comment)
                    <div class="bg-white p-4 rounded border">
                        <p class="font-bold text-sm text-gray-700">{{ $comment->user->name }}</p>
                        <p class="text-gray-600 text-xs mb-2">{{ $comment->created_at->diffForHumans() }}</p>
                        <p>{{ $comment->body }}</p>
                    </div>
                @empty
                    <p class="text-gray-500 italic">No comments yet. Be the first to share your thoughts!</p>
                @endforelse
            </div>
        </div>

    </div>
</x-layout>