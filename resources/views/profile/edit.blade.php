@extends('layouts.app')

@section('title', 'Profile')
@section('subtitle', 'Manage your account settings.')

@section('content')
    <section class="grid">
        <article class="panel">
            <div class="panel-head">
                <div>
                    <h2 class="panel-title">Profile information</h2>
                    <p class="panel-subtitle">Update your account details and email address.</p>
                </div>
            </div>

            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </article>

        <article class="panel">
            <div class="panel-head">
                <div>
                    <h2 class="panel-title">Password</h2>
                    <p class="panel-subtitle">Use a strong password to keep your account secure.</p>
                </div>
            </div>

            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </article>
    </section>

    <section class="panel">
        <div class="panel-head">
            <div>
                <h2 class="panel-title">Delete account</h2>
                <p class="panel-subtitle">Use this only if you no longer need your account.</p>
            </div>
        </div>

        <div class="max-w-xl">
            @include('profile.partials.delete-user-form')
        </div>
    </section>
@endsection
