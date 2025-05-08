<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Auction Nation') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Alpine.js -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <!-- Autocomplete (only loaded on car form pages) -->
        @if(request()->is('cars/create*') || request()->is('cars/*/edit*'))
            <link rel="stylesheet" href="{{ asset('css/autocomplete.css') }}">
            <script src="{{ asset('js/car-data.js') }}"></script>
            <script src="{{ asset('js/car-attributes-data.js') }}"></script>
            <script src="{{ asset('js/car-variants-data.js') }}"></script>
            <script src="{{ asset('js/autocomplete.js') }}"></script>
            <script src="{{ asset('js/car-autocomplete.js') }}"></script>
        @endif

        <style>
            body {
                font-family: 'DM Sans', sans-serif;
                background-color: #F5F4F6;
            }

            .btn-loading {
                position: relative;
                color: transparent !important;
            }

            .btn-loading::after {
                content: '';
                position: absolute;
                width: 20px;
                height: 20px;
                top: 50%;
                left: 50%;
                margin-top: -10px;
                margin-left: -10px;
                border-radius: 50%;
                border: 2px solid rgba(255, 255, 255, 0.2);
                border-top-color: white;
                animation: spin 0.8s linear infinite;
            }

            @keyframes spin {
                to { transform: rotate(360deg); }
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-50">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-200 mt-8">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col md:flex-row justify-between items-center">
                        <div class="mb-4 md:mb-0">
                            <p class="text-sm text-gray-500">&copy; {{ date('Y') }} {{ config('app.name') }}. {{ __('All rights reserved.') }}</p>
                        </div>
                        <div class="flex space-x-6">
                            <a href="#" class="text-gray-500 hover:text-gray-700">
                                <span class="sr-only">Terms</span>
                                <span class="text-sm">Terms of Service</span>
                            </a>
                            <a href="#" class="text-gray-500 hover:text-gray-700">
                                <span class="sr-only">Privacy</span>
                                <span class="text-sm">Privacy Policy</span>
                            </a>
                            <a href="#" class="text-gray-500 hover:text-gray-700">
                                <span class="sr-only">Contact</span>
                                <span class="text-sm">Contact Us</span>
                            </a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Fix for CSRF token
                window.Laravel = {
                    csrfToken: '{{ csrf_token() }}'
                };

                // Fix for sessionStorage error
                try {
                    // Test sessionStorage access
                    sessionStorage.getItem('test');
                } catch (e) {
                    // Create a mock sessionStorage if access is denied
                    window.sessionStorage = {
                        getItem: function() { return null; },
                        setItem: function() {},
                        removeItem: function() {}
                    };
                }

                // Form submission loading state
                const forms = document.querySelectorAll('form');
                forms.forEach(form => {
                    form.addEventListener('submit', function() {
                        const submitBtn = this.querySelector('button[type="submit"]');
                        if (submitBtn) {
                            submitBtn.classList.add('btn-loading');
                            submitBtn.disabled = true;
                        }
                    });
                });
            });
        </script>
    </body>
</html>
