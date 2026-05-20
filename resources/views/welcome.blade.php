<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Task Management AI</title>

        @vite([
            'resources/css/app.css',
            'resources/js/app.js'
        ])
    </head>
    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="bg-blue-500 hover:bg-blue-600 transition px-8 py-4 rounded-2xl font-semibold shadow-lg">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-600 transition px-8 py-4 rounded-2xl font-semibold shadow-lg">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-blue-500 hover:bg-blue-600 transition px-8 py-4 rounded-2xl font-semibold shadow-lg">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="max-w-7xl mx-auto p-6 lg:p-8">
                <div class="flex justify-center">
                    <h1 class="text-5xl lg:text-6xl font-bold leading-tight mb-6">
                        AI-Powered
                        <span class="text-blue-400">
                            Task Management
                        </span>
                        System
                    </h1>
                </div>

                
            </div>
        </div>
    </body>
</html>
