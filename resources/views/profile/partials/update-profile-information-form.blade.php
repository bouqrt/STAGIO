<section class="section-stack">
    <header>
        <h3 class="panel-title">Profile information</h3>
        <p class="panel-subtitle">Update your name and email.</p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="form-grid">
        @csrf
        @method('patch')

        {{-- Update the user name --}}
        <div class="field-group">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        {{-- Update the user email --}}
        <div class="field-group">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div class="inline-actions">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p class="muted-text">Saved successfully.</p>
            @endif
        </div>
    </form>
</section>
