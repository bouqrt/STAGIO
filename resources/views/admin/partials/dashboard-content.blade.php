{{-- Admin dashboard summary --}}
<section class="stats-grid">
    <article class="stat-card">
        <p class="stat-label">Users</p>
        <p class="stat-value">{{ $stats['users'] ?? 0 }}</p>
    </article>

    <article class="stat-card">
        <p class="stat-label">Students</p>
        <p class="stat-value">{{ $stats['students'] ?? 0 }}</p>
    </article>

    <article class="stat-card">
        <p class="stat-label">Entreprises</p>
        <p class="stat-value">{{ $stats['entreprises'] ?? 0 }}</p>
    </article>

    <article class="stat-card">
        <p class="stat-label">Offers</p>
        <p class="stat-value">{{ $stats['offers'] ?? 0 }}</p>
    </article>

    <article class="stat-card">
        <p class="stat-label">Applications</p>
        <p class="stat-value">{{ $stats['applications'] ?? 0 }}</p>
    </article>

    <article class="stat-card">
        <p class="stat-label">Accepted</p>
        <p class="stat-value">{{ $stats['accepted'] ?? 0 }}</p>
    </article>
</section>

<section class="grid">
    <article class="panel">
        <div class="panel-head">
            <div>
                <h2 class="panel-title">Recent users</h2>
                <p class="panel-subtitle">Latest registered users.</p>
            </div>
        </div>

        @if(($recentUsers ?? collect())->isEmpty())
            <div class="empty-state">
                <strong>No users found</strong>
                <p>The list of users will appear here.</p>
            </div>
        @else
            <div class="list-stack">
                @foreach($recentUsers as $recentUser)
                    <div class="list-item">
                        <div class="list-item-main">
                            <p class="list-item-title">{{ $recentUser->name }}</p>
                            <p class="list-item-meta">{{ ucfirst($recentUser->role) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </article>

    <article class="panel">
        <div class="panel-head">
            <div>
                <h2 class="panel-title">Recent offers</h2>
                <p class="panel-subtitle">Latest offers created on the platform.</p>
            </div>
        </div>

        @if(($recentOffers ?? collect())->isEmpty())
            <div class="empty-state">
                <strong>No offers found</strong>
                <p>The list of offers will appear here.</p>
            </div>
        @else
            <div class="list-stack">
                @foreach($recentOffers as $recentOffer)
                    <div class="list-item">
                        <div class="list-item-main">
                            <p class="list-item-title">{{ $recentOffer->title }}</p>
                            <p class="list-item-meta">{{ optional($recentOffer->entreprise)->name ?? 'No entreprise' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </article>
</section>

<section class="panel">
    <div class="panel-head">
        <div>
            <h2 class="panel-title">Recent applications</h2>
            <p class="panel-subtitle">Latest applications sent on the website.</p>
        </div>
    </div>

    @if(($recentCandidatures ?? collect())->isEmpty())
        <div class="empty-state">
            <strong>No applications found</strong>
            <p>The list of applications will appear here.</p>
        </div>
    @else
        <div class="list-stack">
            @foreach($recentCandidatures as $recentCandidature)
                <div class="list-item">
                    <div class="list-item-main">
                        <p class="list-item-title">{{ $recentCandidature->user->name }}</p>
                        <p class="list-item-meta">{{ $recentCandidature->offre->title }} - {{ ucfirst($recentCandidature->status) }}</p>
                    </div>
                    <span class="badge {{ $recentCandidature->status }}">{{ ucfirst($recentCandidature->status) }}</span>
                </div>
            @endforeach
        </div>
    @endif
</section>
