<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Jayusman Minimarket</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
        <style>
            body {
                background: linear-gradient(135deg, #e0f7fa, #80deea);
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="bg-gray-100 min-h-screen flex items-center justify-center">
        <!-- Full-width Container -->
        <div class="flex items-center justify-between w-full max-w-6xl px-8 py-12">
            <!-- Left Section: Text and Button -->
            <div class="w-full md:w-1/2 pr-8">
                <h1 class="text-5xl font-extrabold text-gray-900 mb-6 leading-snug">
                    Selamat Datang di<br><span class="text-blue-600">Jayusman Minimarket</span>
                </h1>
                <p class="text-lg text-gray-700 mb-8 leading-relaxed">
                    Temukan kebutuhan harian Anda dengan cara yang lebih cepat, mudah, dan menyenangkan. Belanja nyaman dari mana saja, kapan saja!
                </p>
                <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
                    LOG IN
                </a>
            </div>
           
            <!-- Right Section: Image -->
            <div class="w-full md:w-1/2 flex justify-center">
    <img src="{{ asset('images/logo.png') }}" alt="Minimarket Illustration" class="w-4/5 md:w-3/5 lg:w-2/3 object-contain transition-transform duration-500 ease-in-out transform hover:scale-110 hover:rotate-3">
</div>

        </div>
    </body>
</html>
