<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>E-Commerce</title>
</head>
<body>
        <header class="bg-white/80 sticky top-0 backdrop-blur-sm border-b">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 flex items-center">
                <a href="/" class="font-bold text-lg">Toko jawir</a>
                <div class="ml-auto flex items-center space-x-3">
                    <a href="{{ route('about') }}" class="font-bold text-lg">About Us</a>
                </div>
            </div>
        </header>

        @yield('content')
    @yield('scripts')
</body>
</html>