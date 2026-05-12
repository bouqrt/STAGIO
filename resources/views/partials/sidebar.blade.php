@php
    $user = auth()->user();
    $isAdmin = $user->role === 'admin';
    $isEntreprise = $user->role === 'entreprise';
    $dashboardHref = url('/dashboard');
    $links = $isAdmin
        ? [
            [
                'label' => 'Dashboard',
                'caption' => 'Statistics',
                'href' => $dashboardHref,
                'active' => request()->routeIs('dashboard') || request()->routeIs('admin.dashboard') || request()->is('dashboard') || request()->is('admin/dashboard'),
            ],
            [
                'label' => 'Offers',
                'caption' => 'All offers',
                'href' => url('/offres'),
                'active' => request()->routeIs('offres.*') || request()->is('offres') || request()->is('offres/*'),
            ],
            [
                'label' => 'Profile',
                'caption' => 'Account',
                'href' => url('/profile'),
                'active' => request()->routeIs('profile.*') || request()->is('profile'),
            ],
        ]
        : ($isEntreprise
        ? [
            [
                'label' => 'Dashboard',
                'caption' => 'Overview',
                'href' => $dashboardHref,
                'active' => request()->routeIs('dashboard') || request()->is('dashboard') || request()->is('entreprise/dashboard'),
            ],
            [
                'label' => 'My Offers',
                'caption' => 'Manage',
                'href' => url('/offres'),
                'active' => request()->routeIs('offres.*') || request()->is('offres') || request()->is('offres/*'),
            ],
            [
                'label' => 'Applications',
                'caption' => 'Review',
                'href' => url('/entreprise/candidatures'),
                'active' => request()->routeIs('entreprise.candidatures.*') || request()->is('entreprise/candidatures') || request()->is('entreprise/candidatures/*'),
            ],
            [
                'label' => 'Settings',
                'caption' => 'Account',
                'href' => url('/profile'),
                'active' => request()->routeIs('profile.*') || request()->is('profile'),
            ],
        ]
        : [
            [
                'label' => 'Dashboard',
                'caption' => 'Overview',
                'href' => $dashboardHref,
                'active' => request()->routeIs('dashboard') || request()->is('dashboard') || request()->is('student/dashboard'),
            ],
            [
                'label' => 'Browse Offers',
                'caption' => 'Explore',
                'href' => url('/offres'),
                'active' => request()->routeIs('offres.*') || request()->is('offres') || request()->is('offres/*'),
            ],
            [
                'label' => 'My Applications',
                'caption' => 'Track',
                'href' => url('/mes-candidatures'),
                'active' => request()->routeIs('student.applications') || request()->is('mes-candidatures') || request()->is('mes-candidatures/*'),
            ],
            [
                'label' => 'Profile',
                'caption' => 'Settings',
                'href' => url('/profile'),
                'active' => request()->routeIs('profile.*') || request()->is('profile'),
            ],
        ]);
@endphp

<aside class="dashboard-sidebar">
    <div class="sidebar-brand">
        <strong>STAGIO</strong>
        <span>{{ $isAdmin ? 'Admin workspace' : ($isEntreprise ? 'Entreprise workspace' : 'Student workspace') }}</span>
    </div>

    <div class="sidebar-card">
        {{-- Show the user only once in the sidebar --}}
        <div class="sidebar-caption">Connected user</div>
        <div class="sidebar-user">{{ $user->name }}</div>
        <div class="sidebar-meta">Status: {{ ucfirst($user->role) }}</div>
    </div>

    <nav class="sidebar-nav" aria-label="Sidebar navigation">
        @foreach($links as $link)
            <a href="{{ $link['href'] }}" class="sidebar-link {{ $link['active'] ? 'active' : '' }}">
                <span class="sidebar-link-text">{{ $link['label'] }}</span>
                <small>{{ $link['caption'] }}</small>
            </a>
        @endforeach
    </nav>

    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-secondary sidebar-logout">Logout</button>
        </form>
    </div>
</aside>
