@extends('layouts.app')

@section('title', 'Verify Email')
@section('content')
    <section class="panel simple-page">
        <div class="section-stack">
            <div>
                <h1 class="page-title">Verify email</h1>
                <p class="page-description">Check your inbox and verify your email address.</p>
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="alert alert-success">A new verification link has been sent.</div>
            @endif

            <div class="inline-actions">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <x-primary-button>{{ __('Resend Verification Email') }}</x-primary-button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-secondary">Logout</button>
                </form>
            </div>
        </div>
    </section>
@endsection
