<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <!-- <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
                    <p class="text-lg font-medium">{{ __("You're logged in!") }}</p>
                </div> -->
            </div>
        </div>
    </div>

    <div class="mt-6">
                        <a href="{{ route('blogs.create') }}" class="inline-block px-4 py-2 bg-blue-500 text-white rounded-md shadow-md hover:bg-blue-600">
                            Create New Post
                        </a>
                    </div>

    <h2 class="mt-4 text-xl font-semibold">All Blogs</h2>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
            @if ($blogs)
                <ul>
                    @foreach ($blogs as $blog)
                        <li class="mb-4 border-b-2 border-gray-200 pb-4">
                            <p class="text-sm text-gray-500">Posted by: {{ $blog->user->name }}</p>
                            <img src="{{ $blog->image_path }}" alt="{{ $blog->caption }}" class="mt-1 w-3/6 h-auto">
                            <h3 class="text-lg font-semibold">{{ $blog->caption }}</h3>
                            <h2 class="text-lg font-semibold">Number of likes: {{ $blog->like_count }}</h2>
                            <form action="{{ route('like.store', $blog->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md shadow-md hover:bg-red-600 transition duration-300 ease-in-out">Delete</button>
                            </form>
                            @if (Auth::id() === $blog->user_id)
                                <a href="{{ route('blogs.edit', $blog->id) }}" class="inline-block px-4 py-2 bg-green-500 text-white rounded-md shadow-md hover:bg-green-600">Edit</a>
                                <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-block px-4 py-2 bg-red-500 text-white rounded-md shadow-md hover:bg-red-600">Delete</button>
                                </form>
                            @endif  
                        </li>
                    @endforeach
                </ul>
                @else
                <p class="text-center text-gray-500 dark:text-gray-400">No posts to display.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
</div>