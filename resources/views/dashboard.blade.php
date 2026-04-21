@extends('layouts.app')

@section('content')

<h1> Student Dashboard</h1>

<div class="grid">

    <div class="card">
        <h3> Voir les offres</h3>
        <p>Consulte les offres disponibles</p>
        <a href="/offres"><button>Voir</button></a>
    </div>

    <div class="card">
        <h3> Mes candidatures</h3>
        <p>Suivre mes demandes</p>
        <a href="/mes-candidatures"><button>Voir</button></a>
    </div>

</div>

@endsection