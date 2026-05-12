@extends('layouts.app')

@section('title', auth()->user()->role === 'entreprise' ? 'My Offers' : 'Offers')
@section('subtitle', auth()->user()->role === 'entreprise' ? 'Manage your offers.' : 'Browse opportunities and apply.')

@section('content')
    <section class="panel">
        <div class="panel-head">
            <div>
                <h2 class="panel-title">{{ auth()->user()->role === 'entreprise' ? 'Offer management' : 'Available offers' }}</h2>
                <p class="panel-subtitle">{{ auth()->user()->role === 'entreprise' ? 'View and manage published offers.' : 'Check the details before you apply.' }}</p>
            </div>

            @if(auth()->user()->role === 'entreprise')
                <a href="{{ route('offres.create') }}" class="btn">Create offer</a>
            @endif
        </div>

        @if($offres->isEmpty())
            <div class="empty-state">
                <strong>No offers available</strong>
                <p>New internship offers will appear here as soon as they are published.</p>
            </div>
        @else
            <div class="list-stack">
                @foreach($offres as $offre)
                    <article class="card">
                        <div class="panel-head" style="margin-bottom: 14px;">
                            <div>
                                <h3 class="panel-title">{{ $offre->title }}</h3>
                                <p class="panel-subtitle">
                                    {{ $offre->location ?? 'Location not specified' }}
                                    @if(!empty($offre->type))
                                        &middot; {{ ucfirst($offre->type) }}
                                    @endif
                                </p>
                            </div>

                            @if(!empty($offre->type))
                                <span class="badge accepted">{{ ucfirst($offre->type) }}</span>
                            @endif
                        </div>

                        <p class="muted-text" style="margin: 0 0 18px;">
                            {{ $offre->description ?? 'No description provided for this offer yet.' }}
                        </p>

                        @if(auth()->user()->role === 'student')
                            <form method="POST" action="/offres/{{ $offre->id }}/apply" enctype="multipart/form-data" class="form-grid">
                                @csrf

                                <div class="field-group">
                                    <label for="cv-{{ $offre->id }}" class="field-label">Upload your CV</label>
                                    <input id="cv-{{ $offre->id }}" type="file" name="cv" required class="field-file">
                                </div>

                                <div class="inline-actions">
                                    <button type="submit" class="btn">Apply now</button>
                                </div>
                            </form>
                        @else
                            <div class="inline-actions">
                                <a href="/entreprise/candidatures" class="btn btn-secondary">View applications</a>
                            </div>
                        @endif
                    </article>
                @endforeach
            </div>
        @endif
    </section>
@endsection
