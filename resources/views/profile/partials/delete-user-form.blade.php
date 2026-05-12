<section class="section-stack">
    <header>
        <h3 class="panel-title">Delete account</h3>
        <p class="panel-subtitle">Enter your password if you want to delete your account.</p>
    </header>

    <form method="post" action="{{ route('profile.destroy') }}" class="form-grid">
        @csrf
        @method('delete')

        {{-- Confirm the password before deletion --}}
        <div class="field-group">
            <x-input-label for="delete_password" :value="__('Password')" />
            <x-text-input id="delete_password" name="password" type="password" autocomplete="current-password" />
            <x-input-error :messages="$errors->userDeletion->get('password')" />
        </div>

        <div class="inline-actions">
            <button type="submit" class="btn btn-danger">Delete account</button>
        </div>
    </form>
</section>
