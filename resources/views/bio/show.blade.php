<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-2">Name: {{ $user->name }}</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">Bio: {{ $user->bio ?? 'No bio available' }}</p>

                @if (Auth::id() === $user->id) <!-- Check if the authenticated user's ID matches the user's ID -->
                    <button id="editBioBtn" class="mt-4 inline-block px-4 py-2 bg-blue-500 text-white rounded-md shadow-md hover:bg-blue-600 transition duration-300 ease-in-out" onclick="toggleBioForm()">
                        Edit Bio
                    </button>

                    <div id="bioForm" class="mt-4 hidden">
                        @if (empty($user->bio)) <!-- Check if the bio is empty -->
                            <form action="{{ route('bio.store', $user->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <textarea name="bio" rows="4" class="w-full border rounded-md p-2" placeholder="Write your bio..."></textarea>
                                <button type="submit" class="mt-2 inline-block px-4 py-2 bg-blue-500 text-white rounded-md shadow-md hover:bg-blue-600 transition duration-300 ease-in-out">
                                    Create Bio
                                </button>
                            </form>
                        @else <!-- If bio exists, show the update form -->
                            <form action="{{ route('bio.store', $user->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <textarea name="bio" rows="4" class="w-full border rounded-md p-2">{{ $user->bio }}</textarea>
                                <button type="submit" class="mt-2 inline-block px-4 py-2 bg-green-500 text-white rounded-md shadow-md hover:bg-green-600 transition duration-300 ease-in-out">
                                    Update Bio
                                </button>
                            </form>
                        @endif
                    </div>
                @endif

                <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-8 p-6">
                @if ($blogs && $blogs->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-6">
                    @foreach ($blogs as $blog)
                    <div class="bg-gray-100 dark:bg-gray-700 rounded-lg overflow-hidden shadow-md transition duration-300 ease-in-out hover:shadow-lg">
                        <div class="flex items-center">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                                Posted by: {{ $blog->user->name }}
                            </p>

                        </div>

                        <img src="{{ $blog->image_path }}" alt="{{ $blog->caption }}" class="w-full max-h-80 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold mb-2 text-black">{{ $blog->caption }}</h3>
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
                                    </svg>{{ $blog->like_count }}
                                    <br>
                                            <!-- Button to show/hide the list of users -->
                                            <button id="showLikesBtn{{ $blog->id }}" class="text-blue-500 hover:text-blue-700" onclick="toggleLikes({{ $blog->id }})">
                                                Show who liked this
                                            </button>

                                            <!-- List of Users Who Liked the Post (Initially hidden) -->
                                            <div id="likesList{{ $blog->id }}" class="mt-2 hidden">
                                                @if ($blog->likes -> count() > 0)
                                                    <p class="font-semibold">Liked by:</p>
                                                    <ul>
                                                        @foreach ($blog->likes as $like)
                                                            <li>{{ $like->user->name }}</li>
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    <p>No one has liked this post yet.</p>
                                                @endif
                                                </div>
                                            </div>
                                </span>
                                <div class="space-x-2">
                                    @if (Auth::id() === $blog->user_id)
                                    <a href="{{ route('blogs.edit', $blog->id) }}" class="inline-block px-3 py-1 text-sm bg-green-500 text-white rounded hover:bg-green-600 transition duration-300 ease-in-out">Edit</a>
                                    <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 text-sm bg-red-500 text-white rounded hover:bg-red-600 transition duration-300 ease-in-out">Delete</button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                            <form action="{{ route('like.bio_store', $blog->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full px-4 py-2 bg-blue-500 text-white rounded-md shadow-md hover:bg-blue-600 transition duration-300 ease-in-out">Like</button>
                            </form>
                        </div>
                        <br>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-center text-gray-500 dark:text-gray-400">No posts to display.</p>
                @endif
            </div>
        </div>
    </div>
            </div>
        </div>
    </div>

    <script>
        function toggleBioForm() {
            const bioForm = document.getElementById('bioForm');
            bioForm.classList.toggle('hidden'); // Toggle the hidden class
        }

        function toggleLikes(blogId) {
            // Get the list of users and the button
            var likesList = document.getElementById('likesList' + blogId);
            var showLikesBtn = document.getElementById('showLikesBtn' + blogId);
            
            // Toggle the visibility
            if (likesList.classList.contains('hidden')) {
                likesList.classList.remove('hidden');
                showLikesBtn.innerHTML = 'Hide who liked this';
            } else {
                likesList.classList.add('hidden');
                showLikesBtn.innerHTML = 'Show who liked this';
            }
        }
    </script>
</x-app-layout>
