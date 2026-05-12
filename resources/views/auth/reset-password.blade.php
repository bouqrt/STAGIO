@extends('layouts.app')

@section('title', 'Reset Password')
@section('content')
    <section class="panel simple-page">
        <div class="section-stack">
            <div>
                <h1 class="page-title">Reset password</h1>
                <p class="page-description">Choose a new password.</p>
            </div>

            <form method="POST" action="{{ route('password.store') }}" class="form-grid">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="field-group">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" type="email" name="email" :value="old('email', $request->email)" required autofocus />
                    <x-input-error :messages="$errors->get('email')" />
                </div>

                <div class="field-group">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" type="password" name="password" required />
                    <x-input-error :messages="$errors->get('password')" />
                </div>

                <div class="field-group">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" type="password" name="password_confirmation" required />
                    <x-input-error :messages="$errors->get('password_confirmation')" />
                </div>

                <div class="inline-actions">
                    <x-primary-button>{{ __('Reset Password') }}</x-primary-button>
                </div>
            </form>
        </div>
    </section>
@endsection
