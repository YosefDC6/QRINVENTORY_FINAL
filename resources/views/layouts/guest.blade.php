<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-gray-900 antialiased">
    <div class="min-h-screen flex flex-col">

        <header class="py-6 flex justify-center">
            @if (isset($logo))
                <div>
                    {{ $logo }}
                </div>
            @endif
        </header>
        
        <main class="flex-1 w-full">
            {{ $slot }}
        </main>

    </div>
</body>
</html>
