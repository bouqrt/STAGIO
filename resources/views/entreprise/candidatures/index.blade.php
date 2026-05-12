@extends('layouts.app')

@section('title', 'Applications')
@section('subtitle', 'Review candidate submissions.')

@section('content')
    <section class="panel">
        <div class="panel-head">
            <div>
                <h2 class="panel-title">Received applications</h2>
                <p class="panel-subtitle">Review applicants and update their status.</p>
            </div>
        </div>

        @if($candidatures->isEmpty())
            <div class="empty-state">
                <strong>No applications yet</strong>
                <p>Your received candidate submissions will appear here once students start applying.</p>
            </div>
        @else
            <div class="list-stack">
                @foreach($candidatures as $candidature)
                    <article class="card">
                        {{-- Keep each application block simple and readable --}}
                        <div class="panel-head" style="margin-bottom:14px;">
                            <div>
                                <h3 class="panel-title">{{ $candidature->user->name }}</h3>
                                <p class="panel-subtitle">Applied to {{ $candidature->offre->title }}</p>
                            </div>
                            <span class="status-badge {{ $candidature->status == 'accepted' ? 'accepted' : '' }} {{ $candidature->status == 'refused' ? 'refused' : '' }} {{ $candidature->status == 'pending' ? 'pending' : '' }}">
                                {{ $candidature->status }}
                            </span>
                        </div>

                        <div class="list-stack" style="margin-bottom:18px;">
                            <div class="list-item">
                                <div class="list-item-main">
                                    <p class="list-item-title">Candidate</p>
                                    <p class="list-item-meta">{{ $candidature->user->email ?? 'Email unavailable' }}</p>
                                </div>
                            </div>

                            <div class="list-item">
                                <div class="list-item-main">
                                    <p class="list-item-title">Curriculum vitae</p>
                                    <p class="list-item-meta">Open the uploaded file in a new tab.</p>
                                </div>

                                @if($candidature->cv)
                                    <a href="{{ route('entreprise.candidatures.cv', $candidature->id) }}" target="_blank" class="btn btn-secondary">View CV</a>
                                @else
                                    <span class="muted-text">No file</span>
                                @endif
                            </div>
                        </div>

                        <div class="inline-actions">
                            <form method="POST" action="/candidatures/{{ $candidature->id }}/accept">
                                @csrf
                                <button type="submit" class="btn">Accept</button>
                            </form>

                            <form method="POST" action="/candidatures/{{ $candidature->id }}/refuse">
                                @csrf
                                <button type="submit" class="btn btn-danger">Refuse</button>
                            </form>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </section>
@endsection
