@extends('layouts.app')

@section('title', 'Confirm Password')
@section('content')
    <section class="panel simple-page">
        <div class="section-stack">
            <div>
                <h1 class="page-title">Confirm password</h1>
                <p class="page-description">Enter your password to continue.</p>
            </div>

            <form method="POST" action="{{ route('password.confirm') }}" class="form-grid">
                @csrf

                <div class="field-group">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" />
                </div>

                <div class="inline-actions">
                    <x-primary-button>{{ __('Confirm') }}</x-primary-button>
                </div>
            </form>
        </div>
    </section>
@endsection
