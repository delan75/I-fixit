<!-- Mobile Header -->
<header class="bg-white shadow-sm border-b border-gray-200 fixed top-0 left-0 right-0 z-30 sm:hidden">
    <div class="px-4 py-3 flex items-center justify-between">
        <!-- Mobile menu button -->
        <button type="button" id="mobile-menu-button" class="btn-icon text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 rounded-lg">
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <!-- Logo -->
        <a href="{{ route('dashboard') }}" class="flex items-center">
            <svg class="h-8 w-8 text-primary" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M19.5 8.5h-1.25V7.25a5.75 5.75 0 00-11.5 0v1.25H5.5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2v-9a2 2 0 00-2-2zm-11.25-1.25a4.25 4.25 0 018.5 0v1.25h-8.5V7.25zm11.75 12.25a.5.5 0 01-.5.5h-14a.5.5 0 01-.5-.5v-9a.5.5 0 01.5-.5h14a.5.5 0 01.5.5v9z"/>
                <path d="M12 14a1 1 0 00-1 1v2a1 1 0 002 0v-2a1 1 0 00-1-1z"/>
            </svg>
            <span class="ml-2 text-xl font-bold text-text">{{ config('app.name', 'I-fixit') }}</span>
        </a>

        <!-- Actions -->
        <div class="flex items-center space-x-3">
            <!-- Notifications -->
            <button type="button" class="btn-icon text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 rounded-lg relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-primary"></span>
            </button>

            <!-- User dropdown -->
            <div class="relative">
                <button type="button" id="user-menu-button" class="flex items-center focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 rounded-full">
                    <span class="sr-only">Open user menu</span>
                    <div class="h-8 w-8 rounded-full bg-primary text-white flex items-center justify-center">
                        {{ substr(Auth::user()->name ?? 'Guest', 0, 1) }}
                    </div>
                </button>

                <!-- Dropdown menu -->
                <div id="user-dropdown" class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 py-1 z-50">
                    @auth
                        <div class="px-4 py-2 border-b border-gray-100">
                            <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                        </div>
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="fas fa-user-circle mr-2 text-gray-400"></i> Profile
                        </a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="fas fa-cog mr-2 text-gray-400"></i> Settings
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-danger hover:bg-gray-100"
                               onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="fas fa-sign-out-alt mr-2"></i> Log Out
                            </a>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="fas fa-sign-in-alt mr-2 text-gray-400"></i> Log In
                        </a>
                        <a href="{{ route('register') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="fas fa-user-plus mr-2 text-gray-400"></i> Register
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Mobile sidebar overlay -->
<div id="sidebar-overlay" class="fixed inset-0 bg-gray-600 bg-opacity-50 z-20 hidden sm:hidden"></div>

<script>
    // Mobile menu toggle
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');

        mobileMenuButton.addEventListener('click', function() {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        });

        overlay.addEventListener('click', function() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });

        // User dropdown
        const userMenuButton = document.getElementById('user-menu-button');
        const userDropdown = document.getElementById('user-dropdown');

        if (userMenuButton && userDropdown) {
            userMenuButton.addEventListener('click', function() {
                userDropdown.classList.toggle('hidden');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(event) {
                if (!userMenuButton.contains(event.target) && !userDropdown.contains(event.target)) {
                    userDropdown.classList.add('hidden');
                }
            });
        }
    });
</script>
