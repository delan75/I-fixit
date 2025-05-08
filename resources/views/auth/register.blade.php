<x-guest-layout>
    <h1 class="auth-title">{{ __('Create your account') }}</h1>
    <p class="auth-subtitle">
        {{ __("Already have an account?") }}
        <a href="{{ route('login') }}" class="form-link">{{ __('Sign in') }}</a>
    </p>

    <!-- Display validation errors -->
    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-50 border-l-4 border-red-500 text-sm font-medium text-red-700 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" x-data="{
        firstNameError: '',
        lastNameError: '',
        emailError: '',
        phoneError: '',
        passwordError: '',
        passwordConfirmationError: ''
    }">
        @csrf
        <!-- Hidden CSRF token for extra security -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

        <!-- First Name -->
        <div class="form-group">
            <label for="first_name" class="form-label">{{ __('First Name') }}</label>
            <input id="first_name" class="form-input" :class="{'is-invalid': firstNameError || '{{ $errors->has('first_name') }}'}"
                   type="text" name="first_name" value="{{ old('first_name') }}"
                   placeholder="Enter your first name" required autofocus autocomplete="given-name"
                   @input="firstNameError = ''" />
            <div class="error-message" x-text="firstNameError">
                @error('first_name')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <!-- Last Name -->
        <div class="form-group">
            <label for="last_name" class="form-label">{{ __('Last Name') }}</label>
            <input id="last_name" class="form-input" :class="{'is-invalid': lastNameError || '{{ $errors->has('last_name') }}'}"
                   type="text" name="last_name" value="{{ old('last_name') }}"
                   placeholder="Enter your last name" required autocomplete="family-name"
                   @input="lastNameError = ''" />
            <div class="error-message" x-text="lastNameError">
                @error('last_name')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <!-- Email Address -->
        <div class="form-group">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" class="form-input" :class="{'is-invalid': emailError || '{{ $errors->has('email') }}'}"
                   type="email" name="email" value="{{ old('email') }}"
                   placeholder="Enter your email" required autocomplete="email"
                   @input="emailError = ''" />
            <div class="error-message" x-text="emailError">
                @error('email')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <!-- Phone Number -->
        <div class="form-group">
            <label for="phone" class="form-label">{{ __('Phone Number') }}</label>
            <div class="phone-input-wrapper">
                <div class="phone-prefix">+27</div>
                <input id="phone" class="form-input phone-input" :class="{'is-invalid': phoneError || '{{ $errors->has('phone') }}'}"
                       type="tel" name="phone" value="{{ old('phone') }}"
                       placeholder="071 234 5678 or 71 234 5678" required
                       @input="phoneError = ''" />
            </div>
            <div class="error-message" x-text="phoneError">
                @error('phone')
                    {{ $message }}
                @enderror
            </div>
            <p class="form-hint">{{ __('Enter your mobile number') }}</p>
        </div>

        <!-- Gender -->
        <div class="form-group">
            <label class="form-label">{{ __('Gender') }}</label>
            <div class="flex space-x-6 mt-2">
                <div class="flex items-center">
                    <input id="gender-male" name="gender" type="radio" value="male" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" {{ old('gender') == 'male' ? 'checked' : '' }}>
                    <label for="gender-male" class="ml-2 block text-sm font-medium leading-6 text-gray-900">{{ __('Male') }}</label>
                </div>
                <div class="flex items-center">
                    <input id="gender-female" name="gender" type="radio" value="female" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" {{ old('gender') == 'female' ? 'checked' : '' }}>
                    <label for="gender-female" class="ml-2 block text-sm font-medium leading-6 text-gray-900">{{ __('Female') }}</label>
                </div>
                <div class="flex items-center">
                    <input id="gender-other" name="gender" type="radio" value="other" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" {{ old('gender') == 'other' ? 'checked' : '' }}>
                    <label for="gender-other" class="ml-2 block text-sm font-medium leading-6 text-gray-900">{{ __('Other') }}</label>
                </div>
            </div>
            <div class="error-message">
                @error('gender')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <div class="password-field">
                <input id="password" class="form-input" :class="{'is-invalid': passwordError || '{{ $errors->has('password') }}'}"
                       type="password" name="password"
                       placeholder="Enter your password" required autocomplete="new-password"
                       @input="passwordError = ''" />
                <button type="button" class="password-toggle">
                    <i class="far fa-eye"></i>
                </button>
            </div>
            <div class="error-message" x-text="passwordError">
                @error('password')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
            <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
            <div class="password-field">
                <input id="password_confirmation" class="form-input" :class="{'is-invalid': passwordConfirmationError || '{{ $errors->has('password_confirmation') }}'}"
                       type="password" name="password_confirmation"
                       placeholder="Confirm your password" required autocomplete="new-password"
                       @input="passwordConfirmationError = ''" />
                <button type="button" class="password-toggle">
                    <i class="far fa-eye"></i>
                </button>
            </div>
            <div class="error-message" x-text="passwordConfirmationError">
                @error('password_confirmation')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <x-primary-button>
            {{ __('Sign up') }}
        </x-primary-button>
    </form>
</x-guest-layout>
