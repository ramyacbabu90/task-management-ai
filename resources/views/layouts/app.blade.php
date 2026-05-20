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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="min-h-screen bg-gradient-to-br from-[#0f172a] via-[#1e293b] to-[#111827] text-white">

<div class="min-h-screen p-6">

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

        <!-- Main Content -->
        <div class="lg:col-span-9">

            <!-- Top Navigation -->
            <div class="flex flex-col md:flex-row justify-between md:items-center gap-4 mb-8">

                <h1 class="text-5xl font-bold">
                    @yield('page-title', 'Task Management')
                </h1>

                <a href="{{ route('tasks.create') }}"
                   class="bg-blue-500 hover:bg-blue-600 transition px-6 py-3 rounded-xl font-semibold shadow-lg">

                    + New Task

                </a>
            </div>

            
            @yield('content')

        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-3">

            <div class="bg-white text-black rounded-3xl overflow-hidden shadow-2xl">

                <div class="p-6 border-b">

                    <div class="flex items-center gap-3">

                        <div class="w-12 h-12 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold">

                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                        </div>

                        <div>

                            <h3 class="font-bold">
                                {{ auth()->user()->name }}
                            </h3>

                            <p class="text-sm text-gray-500 capitalize">
                                {{ auth()->user()->role->value }}
                            </p>

                        </div>

                    </div>

                </div>

                <div class="flex flex-col">

                    <a href="{{ route('tasks.index') }}"
                       class="px-6 py-4 hover:bg-blue-500 hover:text-white transition">

                        Tasks

                    </a>
                    @if(auth()->user()->role->value === 'admin')

                        <a href="{{ route('users.index') }}"
                        class="px-6 py-4 hover:bg-blue-500 hover:text-white transition">

                            Users

                        </a>

                    @endif
                    <a href="{{ route('dashboard') }}"
                       class="px-6 py-4 hover:bg-blue-500 hover:text-white transition">

                        Dashboard

                    </a>

                    <form method="POST"
                          action="{{ route('logout') }}">

                        @csrf

                        <button class="w-full text-left px-6 py-4 hover:bg-red-500 hover:text-white transition">

                            Logout

                        </button>

                    </form>

                </div>

                <!-- Analytics -->
                <div class="p-6 border-t">

                    <h3 class="font-semibold mb-4">
                        Monthly Task Completion
                    </h3>

                    <canvas id="sidebarChart"></canvas>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

const sidebarCtx = document.getElementById('sidebarChart');

if (sidebarCtx) {

    new Chart(sidebarCtx, {
        type: 'bar',

        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],

            datasets: [{
                label: 'Tasks',

                data: [12, 19, 10, 18, 5],

                borderWidth: 1
            }]
        },

        options: {
            responsive: true,
        }
    });

}

</script>

</body>
</html>