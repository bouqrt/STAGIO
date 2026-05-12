@extends('layouts.app')

@section('title', 'Create Offer')
@section('subtitle', 'Create a new internship offer.')

@section('content')
    <section class="form-card">
        <div class="panel-head">
            <div>
                <h2 class="panel-title">New offer</h2>
                <p class="panel-subtitle">Add the basic information for the offer.</p>
            </div>
        </div>

        <form method="POST" action="/offres" class="form-grid">
            @csrf

            {{-- Basic offer information --}}
            <div class="field-group">
                <label for="title" class="field-label">Title</label>
                <input id="title" name="title" class="field-input" placeholder="Internship title">
            </div>

            <div class="field-group">
                <label for="description" class="field-label">Description</label>
                <textarea id="description" name="description" class="field-textarea" placeholder="Describe the offer"></textarea>
            </div>

            <div class="field-row">
                <div class="field-group">
                    <label for="location" class="field-label">Location</label>
                    <input id="location" name="location" class="field-input" placeholder="Casablanca, Remote, Hybrid">
                </div>

                <div class="field-group">
                    <label for="type" class="field-label">Type</label>
                    <select id="type" name="type" class="field-select">
                        <option value="stage">Stage</option>
                        <option value="alternance">Alternance</option>
                    </select>
                </div>
            </div>

            <div class="page-actions">
                <button type="submit" class="btn">Create offer</button>
            </div>
        </form>
    </section>
@endsection
