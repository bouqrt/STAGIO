<section class="section-stack">
    <header>
        <h3 class="panel-title">Password</h3>
        <p class="panel-subtitle">Change your password.</p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="form-grid">
        @csrf
        @method('put')

        {{-- Current password --}}
        <div class="field-group">
            <x-input-label for="update_password_current_password" :value="__('Current Password')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" />
        </div>

        {{-- New password --}}
        <div class="field-group">
            <x-input-label for="update_password_password" :value="__('New Password')" />
            <x-text-input id="update_password_password" name="password" type="password" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" />
        </div>

        {{-- Confirm the new password --}}
        <div class="field-group">
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" />
        </div>

        <div class="inline-actions">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p class="muted-text">Password updated.</p>
            @endif
        </div>
    </form>
</section>
