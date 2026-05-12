@extends('layouts.app')

@section('title', 'Entreprise Profile')
@section('subtitle', 'Create the entreprise profile.')

@section('content')
    <section class="form-card">
        <div class="panel-head">
            <div>
                <h2 class="panel-title">{{ $entreprise ? 'Edit entreprise profile' : 'Create entreprise profile' }}</h2>
                <p class="panel-subtitle">Add or update the basic company information.</p>
            </div>
        </div>

        <form method="POST" action="{{ route('entreprise.store') }}" class="form-grid">
            @csrf

            {{-- Basic entreprise information --}}
            <div class="field-row">
                <div class="field-group">
                    <label for="name" class="field-label">Company name</label>
                    <input id="name" name="name" class="field-input" placeholder="Company name" value="{{ old('name', $entreprise?->name ?? auth()->user()->name) }}">
                    <x-input-error :messages="$errors->get('name')" />
                </div>

                <div class="field-group">
                    <label for="email" class="field-label">Email</label>
                    <input id="email" name="email" class="field-input" placeholder="contact@company.com" value="{{ old('email', $entreprise?->email ?? auth()->user()->email) }}">
                    <x-input-error :messages="$errors->get('email')" />
                </div>
            </div>

            <div class="field-row">
                <div class="field-group">
                    <label for="phone" class="field-label">Phone</label>
                    <input id="phone" name="phone" class="field-input" placeholder="+212 ..." value="{{ old('phone', $entreprise?->phone) }}">
                    <x-input-error :messages="$errors->get('phone')" />
                </div>

                <div class="field-group">
                    <label for="address" class="field-label">Address</label>
                    <input id="address" name="address" class="field-input" placeholder="Office address" value="{{ old('address', $entreprise?->address) }}">
                    <x-input-error :messages="$errors->get('address')" />
                </div>
            </div>

            <div class="field-group">
                <label for="description" class="field-label">Description</label>
                <textarea id="description" name="description" class="field-textarea" placeholder="Describe your company">{{ old('description', $entreprise?->description) }}</textarea>
                <x-input-error :messages="$errors->get('description')" />
            </div>

            <div class="page-actions">
                <button type="submit" class="btn">Save profile</button>
            </div>
        </form>
    </section>
@endsection
