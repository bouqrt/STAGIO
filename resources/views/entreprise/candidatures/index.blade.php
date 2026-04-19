@extends('layouts.app')

@section('content')

<h1>Candidatures reçues</h1>

@foreach($candidatures as $candidature)
    <div class="card">

        <p><strong>Student:</strong> {{ $candidature->user->name }}</p>
        <p><strong>Offre:</strong> {{ $candidature->offre->title }}</p>

        <p class="status 
            {{ $candidature->status == 'accepted' ? 'accepted' : '' }}
            {{ $candidature->status == 'refused' ? 'refused' : '' }}
            {{ $candidature->status == 'pending' ? 'pending' : '' }}">
            
            {{ $candidature->status }}
        </p>

        @if($candidature->cv)
            <a href="{{ asset('storage/' . $candidature->cv) }}" target="_blank">
                Voir CV
            </a>
        @endif

        <br><br>

        <form method="POST" action="/candidatures/{{ $candidature->id }}/accept" style="display:inline;">
            @csrf
            <button type="submit">Accepter</button>
        </form>

        <form method="POST" action="/candidatures/{{ $candidature->id }}/refuse" style="display:inline;">
            @csrf
            <button type="submit" class="btn-danger">Refuser</button>
        </form>

    </div>
@endforeach

@endsection