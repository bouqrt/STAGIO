<h1>Offres disponibles</h1>

@foreach($offres as $offre)
    <div style="border:1px solid #ccc; margin:10px; padding:10px;">
        <h3>{{ $offre->title }}</h3>
        <p>{{ $offre->description }}</p>
        <p><strong>Lieu:</strong> {{ $offre->location }}</p>
        <p><strong>Type:</strong> {{ $offre->type }}</p>
    </div>
@endforeach