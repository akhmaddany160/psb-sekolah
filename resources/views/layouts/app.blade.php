<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-100">
        <div class="min-h-screen flex">
            @include('layouts.navigation')

            <div class="flex-1 flex flex-col">
                <header class="bg-white shadow-sm border-b border-gray-100 py-6 px-10">
                    <h1 class="text-3xl font-bold text-gray-800 tracking-tight text-center">
                        <span class="font-light text-gray-400">PKBM</span> Abu Dzar Al-Ghifari
                    </h1>
                </header>

                <main class="flex-1 flex flex-col items-center justify-center p-6">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>