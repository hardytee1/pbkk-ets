<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg p-6 mb-8">
                <div class="flex items-center space-x-4">
                    <!-- <div class="flex-shrink-0">
                        <img class="h-24 w-24 rounded-full object-cover" src="https://via.placeholder.com/150" alt="{{ $user->name }}">
                    </div> -->
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $user->name }}</h3>
                        <p class="text-gray-600 dark:text-gray-400 mt-1">{{ $user->bio ?? 'No bio available' }}</p>
                    </div>
                </div>

                @if (Auth::id() === $user->id)
                <button id="editBioBtn" class="mt-6 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-800 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150" onclick="toggleBioForm()">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                    </svg>
                    Edit Bio
                </button>

                <div id="bioForm" class="mt-6 hidden">
                    <form action="{{ route('bio.store', $user->id) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PATCH')
                        <textarea name="bio" rows="4" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:border-blue-500 dark:bg-gray-700 dark:text-gray-300" placeholder="Write your bio...">{{ $user->bio }}</textarea>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-800 focus:outline-none focus:border-green-800 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            {{ empty($user->bio) ? 'Create Bio' : 'Update Bio' }}
                        </button>
                    </form>
                </div>
                @endif
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-6 text-gray-900 dark:text-gray-100">Posts</h3>
                @if ($blogs && $blogs->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($blogs as $blog)
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg overflow-hidden shadow-md transition duration-300 ease-in-out hover:shadow-lg">
                        <img src="{{ asset('storage/' . $blog->image_path) }}" alt="{{ $blog->caption }}" class="w-full h-64 object-cover">
                        <div class="p-6">
                            <h4 class="text-lg font-semibold mb-2 text-gray-900 dark:text-gray-100">{{ $blog->caption }}</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                                Posted by {{ $blog->user->name }} &middot; {{ $blog->created_at->diffForHumans() }}
                            </p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $blog->like_count }}</span>
                                </div>
                                <button class="show-likes-btn text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 transition duration-150 ease-in-out" data-blog-id="{{ $blog->id }}">
                                    Show who liked this
                                </button>
                            </div>
                            <div id="likesList{{ $blog->id }}" class="mt-4 hidden">
                                @if ($blog->likes->count() > 0)
                                <h5 class="font-semibold text-sm text-gray-700 dark:text-gray-300 mb-2">Liked by:</h5>
                                <ul class="list-disc list-inside text-sm text-gray-600 dark:text-gray-400">
                                    @foreach ($blog->likes as $like)
                                    <li>{{ $like->user->name }}</li>
                                    @endforeach
                                </ul>
                                @else
                                <p class="text-sm text-gray-600 dark:text-gray-400">No one has liked this post yet.</p>
                                @endif
                            </div>
                            <div class="mt-6 flex justify-between items-center">
                                @if (Auth::id() === $blog->user_id)
                                <div class="space-x-2">
                                    <a href="{{ route('blogs.edit', $blog->id) }}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                                @endif
                                <form action="{{ route('like.bio_store', $blog->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-800 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
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
                <p class="text-center text-gray-500 dark:text-gray-400">No posts to display.</p>
                @endif
            </div>
        </div>
    </div>

    <script>
        function toggleBioForm() {
            const bioForm = document.getElementById('bioForm');
            bioForm.classList.toggle('hidden');
        }

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
                    button.textContent = 'Hide who liked this';
                } else {
                    likesListElement.classList.add('hidden');
                    button.textContent = 'Show who liked this';
                }
            }
        });
    </script>
</x-app-layout>