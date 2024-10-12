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

            <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-200">All Blogs</h2>

            <div class="bg-white dark:bg-gray-800 overflow-hidden w-fit shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if ($blogs && $blogs->count() > 0)
                    <ul class="space-y-8">
                        @foreach ($blogs as $blog)
                        <li class="border-b border-gray-200 dark:border-gray-700 pb-8 last:border-b-0">
                            <div class="flex flex-col md:justify-between">
                                <div class="flex-grow">
                                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">{{ $blog->caption }}</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Posted by: {{ $blog->user->name }}</p>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center justify-center">
                                <img src="{{ $blog->image_path }}" alt="{{ $blog->caption }}" class="w-full md:w-3/4 lg:w-1/2 h-auto rounded-lg shadow-md">
                            </div>
                            <div class="flex items-center space-x-4 mt-4 md:mt-0">
                                <span class="text-lg font-semibold text-gray-700 dark:text-gray-300">
                                    {{ $blog->like_count }} {{ Str::plural('like', $blog->like_count) }}
                                </span>
                                {{-- <form action="{{ route('like.store', $blog->id) }}" method="POST" class="inline-block">
                                @csrf
                                <button type="submit" class="px-4 py-2 bg-pink-500 text-white rounded-md shadow-md hover:bg-pink-600 transition duration-300 ease-in-out">
                                    Like
                                </button>
                                </form> --}}
                            </div>
                            {{-- @if (Auth::id() === $blog->user_id)
                                        <div class="mt-4 space-x-4">
                                            <a href="{{ route('posts.edit', $blog->id) }}" class="inline-block px-4 py-2 bg-green-500 text-white rounded-md shadow-md hover:bg-green-600 transition duration-300 ease-in-out">Edit</a>
                            <form action="{{ route('posts.destroy', $blog->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md shadow-md hover:bg-red-600 transition duration-300 ease-in-out">Delete</button>
                            </form>
                </div>
                @endif --}}
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