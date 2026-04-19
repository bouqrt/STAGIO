@extends('layouts.app')

@section('content')

<h1>Offres disponibles</h1>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

@foreach($offres as $offre)
    <div class="card">
        <h3>{{ $offre->title }}</h3>

        <form method="POST" action="/offres/{{ $offre->id }}/apply" enctype="multipart/form-data">
            @csrf
            <input type="file" name="cv" required>
            <button type="submit">Postuler</button>
        </form>
    </div>
@endforeach

@endsection