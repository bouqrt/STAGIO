@extends('layouts.app')

@section('content')

<h1> Entreprise Dashboard </h1>

<div class="grid">

    <div class="card">
        <h3> Gérer les offres</h3>
        <a href="/offres"><button>Voir</button></a>
    </div>

    <div class="card">
        <h3>  Candidatures</h3>
        <a href="/entreprise/candidatures"><button>Voir</button></a>
    </div>

</div>

@endsection