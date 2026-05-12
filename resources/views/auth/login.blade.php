@extends('layouts.app')

@section('title', 'Login')
@section('content')
    <section class="panel simple-page">
        <div class="section-stack">
            <div>
                <h1 class="page-title">Login</h1>
                <p class="page-description">Access your dashboard and applications.</p>
            </div>

            <x-auth-session-status class="alert alert-success" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="form-grid">
                @csrf

                {{-- User email --}}
                <div class="field-group">
                    <label for="email" class="field-label">Email</label>
                    <input id="email" class="auth-input" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                    <x-input-error :messages="$errors->get('email')" />
                </div>

                {{-- User password --}}
                <div class="field-group">
                    <label for="password" class="field-label">Password</label>
                    <input id="password" class="auth-input" type="password" name="password" required autocomplete="current-password">
                    <x-input-error :messages="$errors->get('password')" />
                </div>

                <label style="display:inline-flex;align-items:center;gap:10px;">
                    <input id="remember_me" type="checkbox" name="remember">
                    <span>Remember me</span>
                </label>

                <div class="inline-actions">
                    @if (Route::has('password.request'))
                        <a class="text-link" href="{{ route('password.request') }}">Forgot password?</a>
                    @endif

                    <button type="submit" class="btn">Login</button>
                </div>
            </form>

            <p class="auth-helper">
                No account yet?
                <a href="{{ route('register') }}" class="text-link">Register</a>
            </p>
        </div>
    </section>
@endsection
