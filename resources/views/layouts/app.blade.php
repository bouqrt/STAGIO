<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - {{ config('app.name', 'Stagio') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    @php($useVite = file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))

    @if ($useVite)
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @endif
</head>
<body>
    @auth
        <div class="dashboard-shell">
            @include('partials.sidebar')

            <main class="main-panel">
                @include('partials.navbar')

                <div class="content-area">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-error">{{ session('error') }}</div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-error">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>
    @else
        <main class="content-area content-area-guest">
            @yield('content')
        </main>
    @endauth
</body>
</html>
