<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form action="{{ route('password.update') }}" method="POST" class="mt-5">
        @csrf
        @method('PUT')

        <!-- Current Password -->
        <label>{{ __('Current Password') }} *</label>
        <input type="password" class="form-control" name="current_password" required>
        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" class="mt-2 text-danger" />

        <!-- New Password -->
        <label>{{ __('New Password') }} *</label>
        <input type="password" class="form-control" name="password" required>
        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" class="mt-2 text-danger" />

        <!-- Confirm Password -->
        <label>{{ __('Confirm New Password') }} *</label>
        <input type="password" class="form-control mb-2" name="password_confirmation" required>
        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-danger" />


        <!-- Submit Button -->
        <button type="submit" class="btn btn-outline-primary-2 mt-3">
            <span>{{ __('CHANGE PASSWORD') }}</span>
            <i class="icon-long-arrow-right"></i>
        </button>

        <!-- Success Message -->
        @if (session('status') === 'password-updated')
        <p class="text-sm text-gray-600 dark:text-gray-400 mt-3">
            {{ __('Saved.') }}
        </p>
        @endif
    </form>
</section>