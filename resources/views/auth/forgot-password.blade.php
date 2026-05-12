@extends('layouts.app')

@section('title', 'Forgot Password')
@section('content')
    <section class="panel simple-page">
        <div class="section-stack">
            <div>
                <h1 class="page-title">Forgot password</h1>
                <p class="page-description">Enter your email to receive a reset link.</p>
            </div>

            <x-auth-session-status class="alert alert-success" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="form-grid">
                @csrf

                <div class="field-group">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" />
                </div>

                <div class="inline-actions">
                    <x-primary-button>{{ __('Send reset link') }}</x-primary-button>
                </div>
            </form>
        </div>
    </section>
@endsection
