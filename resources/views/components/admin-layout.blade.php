<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Administrator' }}</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

</head>

<body class="bg-gray-50 dark:bg-gray-900">

    <x-admin-navbar />

    <x-admin-sidebar />

    <main class="p-4 md:ml-64 h-auto pt-20">

        @if(session('success'))
            <div class="mb-4 p-4 text-green-800 bg-green-100 border border-green-300 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 p-4 text-red-800 bg-red-100 border border-red-300 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        {{ $slot }}

    </main>

    @stack('scripts')

</body>

</html>