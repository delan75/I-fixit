<!-- Sidebar -->
<aside id="sidebar" class="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('dashboard') }}" class="flex items-center">
            <svg class="h-8 w-8 text-primary" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M19.5 8.5h-1.25V7.25a5.75 5.75 0 00-11.5 0v1.25H5.5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2v-9a2 2 0 00-2-2zm-11.25-1.25a4.25 4.25 0 018.5 0v1.25h-8.5V7.25zm11.75 12.25a.5.5 0 01-.5.5h-14a.5.5 0 01-.5-.5v-9a.5.5 0 01.5-.5h14a.5.5 0 01.5.5v9z"/>
                <path d="M12 14a1 1 0 00-1 1v2a1 1 0 002 0v-2a1 1 0 00-1-1z"/>
            </svg>
            <span class="ml-2 text-xl font-bold text-text">{{ config('app.name', 'I-fixit') }}</span>
        </a>
    </div>

    <div class="py-4">
        <nav>
            <div class="px-5 mb-4">
                <p class="text-xs uppercase font-semibold text-gray-500 tracking-wider">Main</p>
            </div>

            <ul>
                <li>
                    <a href="{{ route('dashboard') }}" class="sidebar-link group {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-th-large sidebar-icon"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="mt-1">
                    <a href="#" class="sidebar-link group">
                        <i class="fas fa-car sidebar-icon"></i>
                        <span>Cars</span>
                        <i class="fas fa-chevron-right ml-auto text-xs text-gray-400 group-hover:text-primary transition-transform duration-200 transform group-hover:translate-x-1"></i>
                    </a>
                </li>

                <li class="mt-1">
                    <a href="#" class="sidebar-link group">
                        <i class="fas fa-tools sidebar-icon"></i>
                        <span>Parts & Repairs</span>
                        <i class="fas fa-chevron-right ml-auto text-xs text-gray-400 group-hover:text-primary transition-transform duration-200 transform group-hover:translate-x-1"></i>
                    </a>
                </li>

                <div class="px-5 mt-6 mb-4">
                    <p class="text-xs uppercase font-semibold text-gray-500 tracking-wider">Analytics</p>
                </div>

                <li>
                    <a href="#" class="sidebar-link group">
                        <i class="fas fa-chart-bar sidebar-icon"></i>
                        <span>Reports</span>
                        <i class="fas fa-chevron-right ml-auto text-xs text-gray-400 group-hover:text-primary transition-transform duration-200 transform group-hover:translate-x-1"></i>
                    </a>
                </li>

                <li class="mt-1">
                    <a href="#" class="sidebar-link group">
                        <i class="fas fa-search-dollar sidebar-icon"></i>
                        <span>Opportunities</span>
                        <i class="fas fa-chevron-right ml-auto text-xs text-gray-400 group-hover:text-primary transition-transform duration-200 transform group-hover:translate-x-1"></i>
                    </a>
                </li>

                <div class="px-5 mt-6 mb-4">
                    <p class="text-xs uppercase font-semibold text-gray-500 tracking-wider">Management</p>
                </div>

                <li>
                    <a href="#" class="sidebar-link group">
                        <i class="fas fa-users sidebar-icon"></i>
                        <span>Suppliers</span>
                        <i class="fas fa-chevron-right ml-auto text-xs text-gray-400 group-hover:text-primary transition-transform duration-200 transform group-hover:translate-x-1"></i>
                    </a>
                </li>

                <li class="mt-1">
                    <a href="{{ route('profile.edit') }}" class="sidebar-link group {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                        <i class="fas fa-cog sidebar-icon"></i>
                        <span>Settings</span>
                        <i class="fas fa-chevron-right ml-auto text-xs text-gray-400 group-hover:text-primary transition-transform duration-200 transform group-hover:translate-x-1"></i>
                    </a>
                </li>
            </ul>

            <div class="px-5 py-5 mt-6 border-t border-gray-100">
                <!-- User Profile -->
                <div class="flex items-center mb-4">
                    <div class="h-10 w-10 rounded-full bg-primary text-white flex items-center justify-center">
                        {{ substr(Auth::user()->name ?? 'Guest', 0, 1) }}
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-800">{{ Auth::user()->name ?? 'Guest' }}</p>
                        <p class="text-xs text-gray-500">{{ Auth::user()->email ?? 'guest@example.com' }}</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" class="sidebar-link group text-danger"
                       onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="fas fa-sign-out-alt sidebar-icon"></i>
                        <span>Log Out</span>
                    </a>
                </form>
            </div>
        </nav>
    </div>
</aside>
