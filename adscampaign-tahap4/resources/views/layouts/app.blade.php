<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>🎮 {{ config('app.name', 'Pixel Quest') }} - Adventure Awaits!</title>

        <!-- Pixel Game Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
        
        <!-- Favicon -->
        <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🎮</text></svg>">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/css/pixel-game.css', 'resources/js/app.js', 'resources/js/pixel-game.js'])
    </head>
    <body>
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="pixel-header">
                    <div class="pixel-container">
                        <h1 data-type>{{ $header }}</h1>
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="pixel-container">
                <!-- Flash Messages -->
                @if(session('status'))
                    <div class="pixel-card pixel-fade-in" style="background: var(--pixel-success); color: white; margin-bottom: 20px;">
                        <div class="pixel-card-header">✅ Success!</div>
                        {{ session('status') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="pixel-card pixel-fade-in" style="background: var(--pixel-primary); color: white; margin-bottom: 20px;">
                        <div class="pixel-card-header">❌ Error!</div>
                        {{ session('error') }}
                    </div>
                @endif

                {{ $slot }}
            </main>

            <!-- Pixel Footer -->
            <footer class="pixel-nav" style="margin-top: 40px; text-align: center; padding: 20px;">
                <div class="pixel-container">
                    <p style="margin: 0; font-size: 10px; opacity: 0.7;">
                        🎮 Powered by Pixel Quest Engine © {{ date('Y') }}
                    </p>
                </div>
            </footer>
        </div>
    </body>
</html>
