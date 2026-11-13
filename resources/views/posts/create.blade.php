<x-layout>
    <div class="max-w-2xl mx-auto p-6 bg-white rounded shadow-md mt-10">
        <h1 class="text-2xl font-bold mb-6">Create a New Post</h1>

        <!-- Global Error Summary -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as$error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('posts.store') }}" method="POST">
            @csrf

            <!-- Title Field -->
            <div class="mb-4">
                <label for="title" class="block font-bold mb-1">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" 
                    class="w-full border rounded p-2 focus:outline-blue-500">
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Body Field -->
            <div class="mb-4">
                <label for="body" class="block font-bold mb-1">Body</label>
                <textarea name="body" id="body" rows="6" 
                    class="w-full border rounded p-2 focus:outline-blue-500">{{ old('body') }}</textarea>
                @error('body')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category Field -->
            <div class="mb-4">
                <label for="category" class="block font-bold mb-1">Category</label>
                <select name="category" id="category" class="w-full border rounded p-2 focus:outline-blue-500">
                    <option value="">Select a Category</option>
                    @foreach(['Announcement', 'Event', 'Missing', 'Found', 'Other'] as $cat)
                        <option value="{{ $cat }}" @selected(old('category') == $cat)>{{$cat }}</option>
                    @endforeach
                </select>
                @error('category')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tags Checkboxes with @checked snippet -->
            <div class="mb-4">
                <label class="block font-bold mb-2">Tags</label>
                <div class="flex flex-wrap gap-4">
                    @foreach($tags as$tag)
                        <label class="flex items-center gap-1 cursor-pointer">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}" 
                                @checked(is_array(old('tags')) && in_array($tag->id, old('tags')))>
                            {{ $tag->name }}
                        </label>
                    @endforeach
                </div>
                @error('tags')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Publish Checkbox -->
            <div class="mb-6">
                <label class="flex items-center gap-2 font-bold cursor-pointer">
                    <input type="checkbox" name="is_published" value="1" @checked(old('is_published'))>
                    Publish immediately?
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Submit Post
            </button>
        </form>
    </div>
</x-layout>