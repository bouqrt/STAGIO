{{-- Student dashboard summary --}}
<section class="grid">
    <article class="panel">
        <div class="panel-head">
            <div>
                <h2 class="panel-title">Offers</h2>
                <p class="panel-subtitle">Latest offers available for students.</p>
            </div>
            <a href="{{ route('offres.index') }}" class="text-link">View all</a>
        </div>

        @if(($offres ?? collect())->isEmpty())
            <div class="empty-state">
                <strong>No offers available</strong>
                <p>Offers will appear here when entreprises create them.</p>
            </div>
        @else
            <div class="list-stack">
                @foreach($offres as $offre)
                    <div class="list-item">
                        <div class="list-item-main">
                            <p class="list-item-title">{{ $offre->title }}</p>
                            <p class="list-item-meta">{{ $offre->location }} - {{ ucfirst($offre->type) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </article>

    <article class="panel">
        <div class="panel-head">
            <div>
                <h2 class="panel-title">My applications</h2>
                <p class="panel-subtitle">Your latest applications.</p>
            </div>
            <a href="{{ route('student.applications') }}" class="text-link">View all</a>
        </div>

        @if(($candidatures ?? collect())->isEmpty())
            <div class="empty-state">
                <strong>No applications yet</strong>
                <p>Apply to an offer to see it here.</p>
            </div>
        @else
            <div class="list-stack">
                @foreach($candidatures as $candidature)
                    <div class="list-item">
                        <div class="list-item-main">
                            <p class="list-item-title">{{ $candidature->offre->title }}</p>
                            <p class="list-item-meta">{{ ucfirst($candidature->status) }}</p>
                        </div>
                        <span class="badge {{ $candidature->status }}">{{ ucfirst($candidature->status) }}</span>
                    </div>
                @endforeach
            </div>
        @endif
    </article>
</section>
