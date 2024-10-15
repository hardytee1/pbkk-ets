<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sosial Media</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- TailwindCSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-100 font-sans antialiased">
    <!-- Hero Section -->
    <section class="relative bg-gray-900 text-white overflow-hidden h-screen">
        <img src="assets/hero.svg" alt="Hero Image" class="absolute inset-0 object-cover opacity-30">
        <div class="relative z-10 flex flex-col items-center justify-center h-full space-y-6 text-center px-6">
            <h1 class="text-5xl font-bold">Instagram Super Lite</h1>
            <p class="text-lg max-w-lg">Connect with friends, share your moments, and explore what's trending.</p>
            <div class="space-x-4">
                <a href="{{ route('register') }}" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-lg transition">Join Now</a>
                <a href="{{ route('login') }}" class="px-6 py-3 bg-transparent border border-white hover:bg-white hover:text-gray-900 rounded-lg transition">Log In</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <!-- <section class="py-12 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto text-center">
            <h2 class="text-4xl font-bold">Why Join Us?</h2>
            <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">Explore features that make your experience unique and fun.</p>

            <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="p-6 bg-gray-100 dark:bg-gray-700 rounded-lg shadow-lg">
                    <img src="https://via.placeholder.com/150" alt="Placeholder" class="mb-4 mx-auto">
                    <h3 class="text-2xl font-semibold mb-2">Share Moments</h3>
                    <p class="text-gray-600 dark:text-gray-400">Easily upload and share your favorite moments with your friends and family.</p>
                </div>
                <div class="p-6 bg-gray-100 dark:bg-gray-700 rounded-lg shadow-lg">
                    <img src="https://via.placeholder.com/150" alt="Placeholder" class="mb-4 mx-auto">
                    <h3 class="text-2xl font-semibold mb-2">Connect with People</h3>
                    <p class="text-gray-600 dark:text-gray-400">Make new friends and reconnect with old ones, all in one place.</p>
                </div>
                <div class="p-6 bg-gray-100 dark:bg-gray-700 rounded-lg shadow-lg">
                    <img src="https://via.placeholder.com/150" alt="Placeholder" class="mb-4 mx-auto">
                    <h3 class="text-2xl font-semibold mb-2">Discover Trends</h3>
                    <p class="text-gray-600 dark:text-gray-400">Stay updated with what's trending globally and locally, in real time.</p>
                </div>
            </div>
        </div>
    </section> -->

    <!-- Footer Section -->
    <!-- <footer class="bg-gray-900 text-gray-300 py-8">
        <div class="max-w-7xl mx-auto text-center">
            <p>&copy; 2024 Sosial Media. All rights reserved.</p>
        </div>
    </footer> -->
</body>

</html>