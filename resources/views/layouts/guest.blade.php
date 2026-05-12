<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Stagio') }}</title>
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
    <div class="auth-shell">
        <div class="auth-layout">
            <section class="auth-hero">
                <div class="auth-badges" style="margin-bottom:22px;">
                    <span class="auth-badge soft">Stagio</span>
                    <span class="auth-badge">Students</span>
                    <span class="auth-badge">Companies</span>
                </div>

                <h1>Modern internship management in one elegant dashboard.</h1>
                <p>Track applications, manage offers, and keep your recruitment flow organized with a cleaner workspace.</p>

                <div class="list-stack" style="margin-top:28px;">
                    <div class="list-item" style="background:rgba(255,255,255,0.14);border-color:rgba(255,255,255,0.18);">
                        <div class="list-item-main">
                            <p class="list-item-title">Centralized dashboards</p>
                            <p class="list-item-meta" style="color:rgba(255,255,255,0.8);">Quick access to offers, applications, and role-based actions.</p>
                        </div>
                    </div>

                    <div class="list-item" style="background:rgba(255,255,255,0.14);border-color:rgba(255,255,255,0.18);">
                        <div class="list-item-main">
                            <p class="list-item-title">Soft professional theme</p>
                            <p class="list-item-meta" style="color:rgba(255,255,255,0.8);">Purple, blush, and light surfaces designed for clarity.</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="auth-panel">
                {{ $slot }}
            </section>
        </div>
    </div>
</body>
</html>
