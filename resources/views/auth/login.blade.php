<x-guest-layout>
    <div x-data="{ activeTab: 'email' }">
        <h1 class="auth-title">{{ __('Sign in to your account') }}</h1>
        <p class="auth-subtitle">
            {{ __("Don't have an account?") }}
            <a href="{{ route('register') }}" class="form-link">{{ __('Sign up') }}</a>
        </p>

        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 p-3 bg-green-50 border-l-4 border-green-500 text-sm font-medium text-green-700 rounded">
                {{ session('status') }}
            </div>
        @endif

        <!-- OTP Sent Status -->
        @if (session('otp_sent'))
            <div class="mb-4 p-3 bg-green-50 border-l-4 border-green-500 text-sm font-medium text-green-700 rounded">
                {{ __('OTP has been sent to your phone number.') }}
            </div>
        @endif

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

        <div class="tab-container">
            <button
                type="button"
                class="auth-tab"
                :class="{ 'active': activeTab === 'email' }"
                @click="activeTab = 'email'"
            >
                {{ __('Email & Password') }}
            </button>
            <button
                type="button"
                class="auth-tab"
                :class="{ 'active': activeTab === 'phone' }"
                @click="activeTab = 'phone'"
            >
                {{ __('Phone Number') }}
            </button>
        </div>

        <!-- Email & Password Form -->
        <div x-show="activeTab === 'email'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
            <form method="POST" action="{{ route('login') }}" x-data="{
                emailError: '',
                passwordError: ''
            }">
                @csrf
                <!-- Hidden CSRF token for extra security -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input id="email" class="form-input" :class="{'is-invalid': emailError || '{{ $errors->has('email') }}'}"
                           type="email" name="email" value="{{ old('email') }}"
                           placeholder="Enter your email" required autofocus autocomplete="username"
                           @input="emailError = ''" />
                    <div class="error-message" x-text="emailError">
                        @error('email')
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
                               placeholder="Enter your password" required autocomplete="current-password"
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

                <!-- Remember Me and Forgot Password -->
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
                        <label for="remember_me" class="text-sm ml-2">{{ __('Remember me') }}</label>
                    </div>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="form-link">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <x-primary-button>
                    {{ __('Sign in') }}
                </x-primary-button>
            </form>
        </div>

        <!-- Phone & OTP Form -->
        <div x-show="activeTab === 'phone'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
            <form method="POST" action="{{ route('login') }}" x-data="{
                otpSent: {{ session('otp_sent') ? 'true' : 'false' }},
                phoneError: '',
                otpError: ''
            }">
                @csrf
                <!-- Hidden CSRF token for extra security -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input type="hidden" name="login_type" value="otp">

                <!-- Phone Number -->
                <div x-show="!otpSent" class="form-group">
                    <label for="phone" class="form-label">{{ __('Phone Number') }}</label>
                    <div class="phone-input-wrapper">
                        <div class="phone-prefix">+27</div>
                        <input id="phone" class="form-input phone-input" :class="{'is-invalid': phoneError || '{{ $errors->has('phone') }}'}"
                               type="tel" name="phone" value="{{ session('phone') }}"
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

                <!-- OTP Code -->
                <div x-show="otpSent" class="form-group">
                    <label for="otp" class="form-label">{{ __('One-Time Password') }}</label>
                    <input id="otp" class="form-input" :class="{'is-invalid': otpError || '{{ $errors->has('otp') }}'}"
                           type="text" name="otp" placeholder="Enter 6-digit code" required
                           @input="otpError = ''" />
                    <div class="error-message" x-text="otpError">
                        @error('otp')
                            {{ $message }}
                        @enderror
                    </div>
                    <p class="form-hint">{{ __('OTP sent to your phone. Valid for 5 minutes.') }}</p>

                    <!-- Hidden phone field to pass the phone number when verifying OTP -->
                    <input type="hidden" name="phone" value="{{ session('phone') }}" />
                </div>

                <!-- Remember Me -->
                <div x-show="otpSent" class="flex items-center mb-6">
                    <input id="remember_me_otp" type="checkbox" class="form-checkbox" name="remember">
                    <label for="remember_me_otp" class="text-sm ml-2">{{ __('Remember me') }}</label>
                </div>

                <div x-show="!otpSent" class="mt-6">
                    <button type="submit" name="action" value="send_otp" class="btn btn-primary">
                        {{ __('Send OTP') }}
                    </button>
                </div>

                <div x-show="otpSent" class="mt-6">
                    <button type="submit" name="action" value="verify_otp" class="btn btn-primary">
                        {{ __('Verify & Sign in') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
