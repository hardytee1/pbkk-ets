<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <a href="{{ route('blogs.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-md shadow-md hover:bg-blue-600 transition duration-300 ease-in-out">
                Create New Post
            </a>
        </div>
    </x-slot>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.body.addEventListener('click', function(event) {
                if (event.target.classList.contains('show-likes-btn')) {
                    const blogId = event.target.getAttribute('data-blog-id');
                    toggleLikes(blogId, event.target);
                }
            });

            function toggleLikes(blogId, button) {
                const likesListElement = document.getElementById(`likesList${blogId}`);

                if (likesListElement.classList.contains('hidden')) {
                    likesListElement.classList.remove('hidden');
                    button.textContent = 'Hide likes';
                } else {
                    likesListElement.classList.add('hidden');
                    button.textContent = 'Show likes';
                }
            }
        });
    </script>


    <div class="py-12 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if ($blogs && $blogs->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($blogs as $blog)
                <div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-lg transition duration-300 ease-in-out hover:shadow-2xl">
                    <img src="{{ $blog->image_path }}" alt="{{ $blog->caption }}" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-2">
                                <!-- <img src="{{ $blog->user->avatar_url }}" alt="{{ $blog->user->name }}" class="w-10 h-10 rounded-full"> -->
                                <div>
                                    <a href="{{ route('bio.show', $blog->user->id) }}" class="text-sm font-medium text-gray-900 dark:text-blue-500 hover:underline">
                                        {{ $blog->user->name }}
                                    </a>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $blog->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <a href="{{ route('bio.show', $blog->user->id) }}" class="text-blue-500 hover:text-blue-600 transition duration-300 ease-in-out">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                        <h3 class="text-xl font-bold mb-2 text-gray-900 dark:text-gray-100">{{ $blog->caption }}</h3>
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $blog->like_count }}</span>
                            </div>
                            <button
                                class="show-likes-btn text-sm text-blue-500 hover:text-blue-600 transition duration-300 ease-in-out"
                                data-blog-id="{{ $blog->id }}">
                                Show likes
                            </button>
                        </div>
                        <div id="likesList{{ $blog->id }}" class="mt-2 hidden">
                            @if ($blog->likes->count() > 0)
                            <p class="font-semibold text-sm text-gray-700 dark:text-gray-300">Liked by:</p>
                            <ul class="mt-1 space-y-1">
                                @foreach ($blog->likes as $like)
                                <li class="text-sm text-gray-600 dark:text-gray-400">{{ $like->user->name }}</li>
                                @endforeach
                            </ul>
                            @else
                            <p class="text-sm text-gray-600 dark:text-gray-400">No likes yet.</p>
                            @endif
                        </div>
                        <div class="mt-4 flex justify-between items-center">
                            <div class="space-x-2">
                                @if (Auth::id() === $blog->user_id)
                                <a href="{{ route('blogs.edit', $blog->id) }}" class="inline-block px-4 py-2 text-sm font-medium text-white bg-green-500 rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-300 ease-in-out">Edit</a>
                                <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-red-500 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-300 ease-in-out">Delete</button>
                                </form>
                                @endif
                            </div>
                            <form action="{{ route('like.store', $blog->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300 ease-in-out">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                                    </svg>
                                    Like
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-12">
                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">No posts</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Get started by creating a new post.</p>
                <div class="mt-6">
                    <a href="{{ route('blogs.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        New Post
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>
    </div>
</x-app-layout>