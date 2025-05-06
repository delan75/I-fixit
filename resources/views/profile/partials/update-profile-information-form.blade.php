<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if (method_exists($user, 'hasVerifiedEmail') && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        @php
            $userGender = $user->gender ?? '';
        @endphp
        <div>
            <x-input-label :value="__('Gender')" />
            <div class="mt-2 flex space-x-6">
                <div class="flex items-center">
                    <input id="gender-male" name="gender" type="radio" value="male" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" {{ old('gender', $userGender) == 'male' ? 'checked' : '' }}>
                    <label for="gender-male" class="ml-2 block text-sm font-medium leading-6 text-gray-900">{{ __('Male') }}</label>
                </div>
                <div class="flex items-center">
                    <input id="gender-female" name="gender" type="radio" value="female" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" {{ old('gender', $userGender) == 'female' ? 'checked' : '' }}>
                    <label for="gender-female" class="ml-2 block text-sm font-medium leading-6 text-gray-900">{{ __('Female') }}</label>
                </div>
                <div class="flex items-center">
                    <input id="gender-other" name="gender" type="radio" value="other" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" {{ old('gender', $userGender) == 'other' ? 'checked' : '' }}>
                    <label for="gender-other" class="ml-2 block text-sm font-medium leading-6 text-gray-900">{{ __('Other') }}</label>
                </div>
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('gender')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
