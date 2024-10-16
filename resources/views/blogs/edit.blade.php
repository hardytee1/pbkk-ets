
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Blog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="mb-4">
                            <label for="caption" class="block text-sm font-medium text-gray-700">Caption</label>
                            <input type="text" name="caption" id="caption" value="{{ $blog->caption }}" class="mt-1 p-2 w-full border-gray-300 rounded-md">
                        </div>

                        <div class="mb-4">
                            <label for="image_path" class="block text-sm font-medium text-gray-700">Image</label>
                            <input type="file" name="image_path" id="image_path" accept="image/jpeg,image/png" value="{{ $blog->image_path }}" class="mt-1 p-2 w-full border-gray-300 rounded-md">
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="inline-block px-4 py-2 bg-blue-500 text-white rounded-md shadow-md hover:bg-blue-600">Update Blog</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>