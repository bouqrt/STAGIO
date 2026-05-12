@extends('layouts.app')

@section('title', 'Welcome')
@section('content')
    <section class="panel simple-page">
        <div class="section-stack">
            <div>
                <h1 class="page-title">Stagio</h1>
                <p class="page-description">A simple platform for internship offers and applications.</p>
            </div>

            <div class="grid">
                <article class="card">
                    <h2 class="panel-title">Student</h2>
                    <p class="panel-subtitle">Browse offers and apply with your CV.</p>
                </article>

                <article class="card">
                    <h2 class="panel-title">Entreprise</h2>
                    <p class="panel-subtitle">Create offers and review applications.</p>
                </article>
            </div>

            <div class="page-actions">
                @guest
                    <a href="{{ route('login') }}" class="btn">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
                @else
                    <a href="{{ route('dashboard') }}" class="btn">Dashboard</a>
                @endguest
            </div>
        </div>
    </section>
@endsection
