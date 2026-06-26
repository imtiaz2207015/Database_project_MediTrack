<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'MediTrack') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@600;700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[radial-gradient(circle_at_top,_#2e7d8c,_#1e2a3a)]">

            <!-- Branding -->
            <div class="text-center mb-6">
                <h1 class="text-4xl font-bold text-white" style="font-family: 'Poppins', sans-serif;">
                    🏥 MediTrack
                </h1>
                <p class="mt-1 text-sm text-teal-200" style="font-family: 'Inter', sans-serif;">
                    Pharmacy Management System
                </p>
            </div>

            <!-- Card -->
            <div class="w-full sm:max-w-md mt-2 px-6 py-8 bg-white/95 border border-teal-500 shadow-xl shadow-[#1e2a3a]/20 overflow-hidden sm:rounded-3xl">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>