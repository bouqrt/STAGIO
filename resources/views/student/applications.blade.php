@extends('layouts.app')

@section('title', 'My Applications')
@section('subtitle', 'Track the applications you sent.')

@section('content')
    <section class="panel">
        <div class="panel-head">
            <div>
                <h2 class="panel-title">My applications</h2>
                <p class="panel-subtitle">All applications sent by the student.</p>
            </div>
        </div>

        @if($candidatures->isEmpty())
            <div class="empty-state">
                <strong>No applications yet</strong>
                <p>Go to the offers page and apply to an offer.</p>
            </div>
        @else
            <div class="list-stack">
                @foreach($candidatures as $candidature)
                    <div class="list-item">
                        <div class="list-item-main">
                            <p class="list-item-title">{{ $candidature->offre->title }}</p>
                            <p class="list-item-meta">{{ $candidature->offre->location ?? 'No location' }}</p>
                        </div>
                        <span class="badge {{ $candidature->status }}">{{ ucfirst($candidature->status) }}</span>
                    </div>
                @endforeach
            </div>
        @endif
    </section>
@endsection
