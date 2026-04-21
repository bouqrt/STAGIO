<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stagio</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>

<div class="app">
    @auth
    <aside class="sidebar">
        <div class="logo">
            <div class="logo-box">S</div>
            <span>STAGIO</span>
        </div>

        <nav>
            <a href="/dashboard" class="{{ request()->is('dashboard') ? 'active' : '' }}">🏠 Dashboard</a>

            @if(auth()->user()->role === 'student')
                <a href="/offres"> Browse Offers</a>
                <a href="/mes-candidatures"> My Applications</a>
            @endif

            @if(auth()->user()->role === 'entreprise')
                <a href="/offres"> My Offers</a>
                <a href="/entreprise/candidatures"> Applications</a>
            @endif

            <a href="#"> Settings</a>
        </nav>
    </aside>
    @endauth

    <main class="main">

        @auth
        <div class="topbar">
            <h2>@yield('title', 'Dashboard')</h2>
            <div class="notif">🔔</div>
        </div>
        @endauth

        <div class="content">
            @yield('content')
        </div>

    </main>

</div>

</body>
</html>