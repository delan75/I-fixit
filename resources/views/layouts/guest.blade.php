<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'I-fixit') }}</title>

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

        <style>
            body {
                background-color: #F5F4F6;
                font-family: 'DM Sans', sans-serif;
                color: #242731;
            }

            .auth-container {
                width: 100%;
                max-width: 450px;
                padding: 0 16px;
                margin: 0 auto;
            }

            .auth-card {
                width: 100%;
                background-color: white;
                border-radius: 12px;
                box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.08);
                overflow: hidden;
                margin: 0 auto;
                padding: 32px;
            }

            .auth-title {
                font-size: 24px;
                font-weight: 700;
                margin-bottom: 8px;
                color: #242731;
                text-align: center;
            }

            .auth-subtitle {
                font-size: 16px;
                color: #7C7C8D;
                margin-bottom: 24px;
                text-align: center;
            }

            .tab-container {
                display: flex;
                border-bottom: 1px solid #E6E8EC;
                margin-bottom: 24px;
            }

            .auth-tab {
                padding: 12px 16px;
                font-weight: 500;
                font-size: 14px;
                color: #7C7C8D;
                cursor: pointer;
                border-bottom: 2px solid transparent;
                transition: all 0.2s;
                flex: 1;
                text-align: center;
            }

            .auth-tab.active {
                color: #10B981;
                border-bottom-color: #10B981;
            }

            .form-group {
                margin-bottom: 20px;
            }

            .form-label {
                display: block;
                font-size: 14px;
                font-weight: 500;
                color: #242731;
                margin-bottom: 8px;
            }

            .form-input {
                width: 100%;
                padding: 12px 16px;
                border: 1px solid #E6E8EC;
                border-radius: 8px;
                font-size: 14px;
                transition: all 0.2s ease;
                background-color: #fff;
            }

            .form-input:focus {
                border-color: #10B981;
                outline: none;
                box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.1);
            }

            .password-field {
                position: relative;
            }

            .password-toggle {
                position: absolute;
                right: 16px;
                top: 50%;
                transform: translateY(-50%);
                background: none;
                border: none;
                cursor: pointer;
                color: #777E90;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .form-checkbox {
                margin-right: 8px;
                border-radius: 4px;
                border-color: #B1B5C3;
                color: #10B981;
            }

            .form-link {
                color: #10B981;
                text-decoration: none;
                font-size: 14px;
                font-weight: 500;
            }

            .form-link:hover {
                text-decoration: underline;
            }

            .btn {
                display: inline-block;
                padding: 12px 16px;
                font-weight: 500;
                text-align: center;
                border-radius: 8px;
                cursor: pointer;
                transition: all 0.2s;
                font-size: 14px;
                border: none;
                width: 100%;
                position: relative;
            }

            .btn-primary {
                background-color: #10B981;
                color: white;
                font-weight: 600;
            }

            .btn-primary:hover {
                background-color: #059669;
            }

            .phone-input-wrapper {
                position: relative;
            }

            .phone-prefix {
                position: absolute;
                left: 16px;
                top: 50%;
                transform: translateY(-50%);
                color: #777E90;
                font-weight: 500;
                font-size: 14px;
            }

            .phone-input {
                padding-left: 52px !important;
            }

            .form-hint {
                font-size: 12px;
                color: #777E90;
                margin-top: 6px;
                display: block;
            }

            .form-footer {
                margin-top: 20px;
                text-align: center;
                font-size: 14px;
                color: #777E90;
            }

            .form-footer a {
                color: #10B981;
                font-weight: 500;
                text-decoration: none;
            }

            .form-footer a:hover {
                text-decoration: underline;
            }

            /* Transitions for tab content */
            .transition {
                transition-property: all;
            }

            .ease-out {
                transition-timing-function: cubic-bezier(0, 0, 0.2, 1);
            }

            .duration-300 {
                transition-duration: 300ms;
            }

            .opacity-0 {
                opacity: 0;
            }

            .opacity-100 {
                opacity: 1;
            }

            /* Form validation styles */
            .form-input.is-invalid {
                border-color: #EF4444;
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23EF4444'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23EF4444' stroke='none'/%3e%3c/svg%3e");
                background-repeat: no-repeat;
                background-position: right 12px center;
                background-size: 16px 16px;
                padding-right: 40px;
            }

            .form-input.is-valid {
                border-color: #10B981;
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%2310B981' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
                background-repeat: no-repeat;
                background-position: right 12px center;
                background-size: 16px 16px;
                padding-right: 40px;
            }

            .error-message {
                color: #EF4444;
                font-size: 12px;
                margin-top: 4px;
                display: none;
            }

            .form-input.is-invalid + .error-message,
            .form-input.is-invalid ~ .error-message {
                display: block;
                animation: fadeIn 0.3s ease-in-out;
            }

            /* Form animations */
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(-10px); }
                to { opacity: 1; transform: translateY(0); }
            }

            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
                20%, 40%, 60%, 80% { transform: translateX(5px); }
            }

            .shake {
                animation: shake 0.6s ease-in-out;
            }

            .form-input:focus {
                animation: focusAnimation 0.3s ease-in-out;
            }

            @keyframes focusAnimation {
                0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.2); }
                70% { box-shadow: 0 0 0 6px rgba(16, 185, 129, 0); }
                100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
            }

            /* Loading spinner */
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

            .btn-primary::after {
                content: '';
                position: absolute;
                top: 50%;
                left: 50%;
                width: 0;
                height: 0;
                background-color: rgba(255, 255, 255, 0.2);
                border-radius: 50%;
                transform: translate(-50%, -50%);
                transition: width 0.6s, height 0.6s;
            }

            .btn-primary:active::after {
                width: 300px;
                height: 300px;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex flex-col justify-center py-10">
            <div class="auth-container">
                <div class="auth-card">
                    {{ $slot }}
                </div>

                <div class="mt-4 text-center text-xs text-gray-500">
                    &copy; {{ date('Y') }} {{ config('app.name') }}. {{ __('All rights reserved.') }}
                </div>
            </div>
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

                // Password toggle functionality
                const passwordToggles = document.querySelectorAll('.password-toggle');

                passwordToggles.forEach(toggle => {
                    toggle.addEventListener('click', function() {
                        const input = this.previousElementSibling;
                        const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                        input.setAttribute('type', type);

                        // Toggle icon
                        if (type === 'password') {
                            this.innerHTML = '<i class="far fa-eye"></i>';
                        } else {
                            this.innerHTML = '<i class="far fa-eye-slash"></i>';
                        }
                    });
                });

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

                // Phone number validation for South African numbers
                const phoneInputs = document.querySelectorAll('input[type="tel"]');
                phoneInputs.forEach(input => {
                    input.addEventListener('input', function() {
                        // Remove non-numeric characters
                        this.value = this.value.replace(/[^0-9]/g, '');

                        // Format as South African mobile number
                        if (this.value.length > 0) {
                            // Handle numbers with leading zero (10 digits) or without (9 digits)
                            let formattedValue = this.value;

                            // Limit to 10 digits
                            if (formattedValue.length > 10) {
                                formattedValue = formattedValue.substring(0, 10);
                            }

                            // Format with spaces for readability
                            if (formattedValue.length === 10 && formattedValue.startsWith('0')) {
                                // Format as 0xx xxx xxxx
                                const firstPart = formattedValue.substring(0, 3);
                                const secondPart = formattedValue.substring(3, 6);
                                const thirdPart = formattedValue.substring(6, 10);

                                if (formattedValue.length <= 6) {
                                    this.value = `${firstPart} ${secondPart}`;
                                } else {
                                    this.value = `${firstPart} ${secondPart} ${thirdPart}`;
                                }
                            } else if (formattedValue.length === 9) {
                                // Format as xx xxx xxxx (without leading zero)
                                const firstPart = formattedValue.substring(0, 2);
                                const secondPart = formattedValue.substring(2, 5);
                                const thirdPart = formattedValue.substring(5, 9);

                                if (formattedValue.length <= 5) {
                                    this.value = `${firstPart} ${secondPart}`;
                                } else {
                                    this.value = `${firstPart} ${secondPart} ${thirdPart}`;
                                }
                            } else {
                                this.value = formattedValue;
                            }
                        }
                    });
                });
            });
        </script>
    </body>
</html>
