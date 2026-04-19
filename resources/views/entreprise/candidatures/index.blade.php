<h1>Candidatures reçues</h1>

@foreach($candidatures as $candidature)
    <div style="border:1px solid black; margin:10px; padding:10px;">
        <p><strong>Student:</strong> {{ $candidature->user->name }}</p>
        <p><strong>Offre:</strong> {{ $candidature->offre->title }}</p>
        <p><strong>Status:</strong> {{ $candidature->status }}</p>
    </div>
    <form method="POST" action="/candidatures/{{ $candidature->id }}/accept" style="display:inline;">
    @csrf
    <button type="submit">Accepter</button>
    </form>

    <form method="POST" action="/candidatures/{{ $candidature->id }}/refuse" style="display:inline;">
    @csrf
    <button type="submit">Refuser</button>
    </form>
@endforeach