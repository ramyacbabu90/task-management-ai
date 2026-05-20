<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Task Management AI</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>

<body class="bg-gray-100 min-h-screen">

    <nav class="bg-white shadow mb-8">

        <div class="container mx-auto px-6 py-4 flex justify-between">

            <div class="flex gap-6">

                <a href="{{ route('dashboard') }}"
                   class="font-semibold text-blue-600">
                    Dashboard
                </a>

                <a href="{{ route('tasks.index') }}"
                   class="font-semibold text-gray-700">
                    Tasks
                </a>

            </div>

            <div class="flex items-center gap-4">

                <span class="text-sm text-gray-600">
                    {{ auth()->user()->name }}
                </span>

                <form action="{{ route('logout') }}"
                      method="POST">

                    @csrf

                    <button class="text-red-500">
                        Logout
                    </button>

                </form>

            </div>

        </div>

    </nav>

    <main class="container mx-auto px-6">
        @yield('content')
    </main>

</body>
</html>