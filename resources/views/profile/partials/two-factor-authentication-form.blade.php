<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Two Factor Authentication') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Add additional security to your account using two-factor authentication.') }}
        </p>
    </header>

    <div class="mt-5">
        @if(! auth()->user()->two_factor_secret)
            {{-- Enable 2FA --}}
            <div>
                <p class="text-sm text-gray-600 mb-3">
                    {{ __('When two-factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone\'s Google Authenticator application.') }}
                </p>

                <form method="POST" action="{{ url('user/two-factor-authentication') }}">
                    @csrf

                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        {{ __('Enable Two-Factor Authentication') }}
                    </button>
                </form>
            </div>
        @else
            {{-- Manage 2FA --}}
            <div>
                <p class="text-sm text-gray-600 mb-3">
                    {{ __('Two-factor authentication is now enabled. Scan the following QR code using your phone\'s authenticator application.') }}
                </p>

                <div class="mt-4 mb-4">
                    {!! auth()->user()->twoFactorQrCodeSvg() !!}
                </div>

                <p class="text-sm text-gray-600 mb-3">
                    {{ __('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two-factor authentication device is lost.') }}
                </p>

                <div class="bg-gray-100 rounded p-3 mb-4 font-mono text-sm">
                    @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes), true) as $code)
                        <div>{{ $code }}</div>
                    @endforeach
                </div>

                <div class="flex space-x-3">
                    <form method="POST" action="{{ url('user/two-factor-recovery-codes') }}">
                        @csrf
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Regenerate Recovery Codes') }}
                        </button>
                    </form>

                    <form method="POST" action="{{ url('user/two-factor-authentication') }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Disable Two-Factor Authentication') }}
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</section>
