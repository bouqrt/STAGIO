@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<h1>Offres disponibles</h1>

@foreach($offres as $offre)
    <div style="border:1px solid #ccc; margin:10px; padding:10px;">
        <h3>{{ $offre->title }}</h3>
        <p>{{ $offre->description }}</p>
        <p><strong>Lieu:</strong> {{ $offre->location }}</p>
        <p><strong>Type:</strong> {{ $offre->type }}</p>
        <form method="POST" action="/offres/{{ $offre->id }}/apply" enctype="multipart/form-data">
            @csrf
            <input type="file" name="cv" required>
            <button type="submit">Postuler</button>
        </form>
    </div>
@endforeach

