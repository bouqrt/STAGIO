@extends('layouts.app')

@section('title', 'Register')
@section('content')
    <section class="panel simple-page">
        <div class="section-stack">
            <div>
                <h1 class="page-title">Create account</h1>
                <p class="page-description">Choose your role and create your account.</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="form-grid">
                @csrf

                {{-- Choose the user role --}}
                <div class="field-group">
                    <label class="field-label">Role</label>
                    <div class="inline-actions">
                        <label><input type="radio" name="role" value="student" {{ old('role', 'student') === 'student' ? 'checked' : '' }}> Student</label>
                        <label><input type="radio" name="role" value="entreprise" {{ old('role') === 'entreprise' ? 'checked' : '' }}> Entreprise</label>
                    </div>
                    <x-input-error :messages="$errors->get('role')" />
                </div>

                <div class="field-group">
                    <label for="name" class="field-label">Name</label>
                    <input id="name" class="auth-input" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                    <x-input-error :messages="$errors->get('name')" />
                </div>

                <div class="field-group">
                    <label for="email" class="field-label">Email</label>
                    <input id="email" class="auth-input" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
                    <x-input-error :messages="$errors->get('email')" />
                </div>

                <div class="field-row">
                    <div class="field-group">
                        <label for="password" class="field-label">Password</label>
                        <input id="password" class="auth-input" type="password" name="password" required autocomplete="new-password">
                        <x-input-error :messages="$errors->get('password')" />
                    </div>

                    <div class="field-group">
                        <label for="password_confirmation" class="field-label">Confirm password</label>
                        <input id="password_confirmation" class="auth-input" type="password" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="inline-actions">
                    <a class="text-link" href="{{ route('login') }}">Already registered?</a>
                    <button type="submit" class="btn">Register</button>
                </div>
            </form>
        </div>
    </section>
@endsection
