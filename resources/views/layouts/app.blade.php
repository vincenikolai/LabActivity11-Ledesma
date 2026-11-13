<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Bulletin - Purok Ledesma</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900 p-6">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold mb-6 text-center">Barangay Bulletin - Purok Ledesma</h1>
        <nav class="mb-6 flex justify-center gap-4">
            <a href="{{ route('posts.index') }}" class="text-blue-600 hover:underline">Posts</a>
            @if(auth()->check() && auth()->user()->author)
                <a href="{{ route('posts.create') }}" class="text-blue-600 hover:underline">New post</a>
            @endif
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-blue-600 hover:underline">Sign out</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Sign in</a>
            @endauth
        </nav>
        @yield('content')
    </div>
</body>
</html>