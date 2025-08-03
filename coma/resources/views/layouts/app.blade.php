<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'COMA'))</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gradient-to-br from-blue-900 via-purple-900 to-indigo-900 dark:from-slate-900 dark:via-gray-900 dark:to-black relative">
            @include('layouts.navigation')

            <!-- Page Content -->
            <main class="pt-24">
                <!-- Page Heading -->
                @isset($header)
                    <div class="bg-gradient-to-r from-purple-700/50 to-blue-700/50 backdrop-blur-md border-b border-white/30 shadow-xl">
                        <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
                            <div class="text-white font-bold text-xl text-shadow-strong">
                                {{ $header }}
                            </div>
                        </div>
                    </div>
                @endisset
                
                <!-- Main Content -->
                <div class="@if(!isset($header)) pt-8 @endif">
                    @yield('content')
                </div>
            </main>
        </div>
        
        <!-- Page Scripts -->
        @yield('scripts')
    </body>
</html>
