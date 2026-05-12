{{-- Entreprise dashboard summary --}}
<section class="stats-grid">
    <article class="stat-card">
        <p class="stat-label">Offers</p>
        <p class="stat-value">{{ $stats['offers'] ?? 0 }}</p>
    </article>

    <article class="stat-card">
        <p class="stat-label">Applications</p>
        <p class="stat-value">{{ $stats['applications'] ?? 0 }}</p>
    </article>

    <article class="stat-card">
        <p class="stat-label">Pending</p>
        <p class="stat-value">{{ $stats['pending'] ?? 0 }}</p>
    </article>

    <article class="stat-card">
        <p class="stat-label">Accepted</p>
        <p class="stat-value">{{ $stats['accepted'] ?? 0 }}</p>
    </article>
</section>

<section class="panel">
    <div class="panel-head">
        <div>
            <h2 class="panel-title">Recent applications</h2>
            <p class="panel-subtitle">Latest applications for your offers.</p>
        </div>
        <a href="{{ route('entreprise.candidatures.index') }}" class="text-link">View all</a>
    </div>

    @if(($recentCandidatures ?? collect())->isEmpty())
        <div class="empty-state">
            <strong>No applications yet</strong>
            <p>Applications will appear here when students apply.</p>
        </div>
    @else
        <div class="list-stack">
            @foreach($recentCandidatures as $candidature)
                <div class="list-item">
                    <div class="list-item-main">
                        <p class="list-item-title">{{ $candidature->user->name }}</p>
                        <p class="list-item-meta">{{ $candidature->offre->title }}</p>
                    </div>
                    <span class="badge {{ $candidature->status }}">{{ ucfirst($candidature->status) }}</span>
                </div>
            @endforeach
        </div>
    @endif
</section>
