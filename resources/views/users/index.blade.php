<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('User Management') }}
            </h2>
            <a href="{{ route('users.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Add New User') }}
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filter Toggle Button -->
            <div class="flex justify-end items-center mb-6">
                <button id="filter-toggle" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    {{ __('Filter & Search') }}
                </button>
            </div>

            <!-- Filters and Search -->
            <div id="filter-section" class="hidden bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('users.index') }}" method="GET">
                        <div class="flex flex-col lg:flex-row lg:items-end lg:space-x-4 space-y-4 lg:space-y-0">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 flex-grow">
                                <!-- Search Bar -->
                                <div>
                                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Search') }}</label>
                                    <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Search by name, email, phone..."
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                </div>

                                <!-- Role Filter -->
                                <div>
                                    <label for="role" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Role') }}</label>
                                    <select id="role" name="role" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                        <option value="">{{ __('All Roles') }}</option>
                                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>{{ __('Admin') }}</option>
                                        <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>{{ __('User') }}</option>
                                    </select>
                                </div>

                                <!-- Status Filter -->
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Status') }}</label>
                                    <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                        <option value="">{{ __('All Statuses') }}</option>
                                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>{{ __('Active') }}</option>
                                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>{{ __('Inactive') }}</option>
                                    </select>
                                </div>

                                <!-- Gender Filter -->
                                <div>
                                    <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Gender') }}</label>
                                    <select id="gender" name="gender" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                        <option value="">{{ __('All Genders') }}</option>
                                        <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>{{ __('Male') }}</option>
                                        <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>{{ __('Female') }}</option>
                                        <option value="other" {{ request('gender') == 'other' ? 'selected' : '' }}>{{ __('Other') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                    </svg>
                                    {{ __('Apply Filters') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- User Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    @if($users->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white">
                                <thead>
                                    <tr>
                                        <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                                        <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                                        <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Phone</th>
                                        <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Gender</th>
                                        <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Role</th>
                                        <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                                        <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                        <tr class="{{ $user->status === 'inactive' ? 'bg-gray-50' : '' }}">
                                            <td class="py-2 px-4 border-b border-gray-200">{{ $user->name }}</td>
                                            <td class="py-2 px-4 border-b border-gray-200">{{ $user->email }}</td>
                                            <td class="py-2 px-4 border-b border-gray-200">{{ $user->phone }}</td>
                                            <td class="py-2 px-4 border-b border-gray-200
                                                {{ $user->gender === 'male' ? 'bg-blue-50' :
                                                   ($user->gender === 'female' ? 'bg-pink-50' :
                                                   ($user->gender === 'other' ? 'bg-gray-50' : '')) }}">
                                                @if($user->gender)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                    {{ $user->gender === 'male' ? 'bg-blue-100 text-blue-800' :
                                                       ($user->gender === 'female' ? 'bg-pink-100 text-pink-800' : 'bg-gray-100 text-gray-800') }}">
                                                    {{ ucfirst($user->gender) }}
                                                </span>
                                                @else
                                                <span class="text-gray-400">Not specified</span>
                                                @endif
                                            </td>
                                            <td class="py-2 px-4 border-b border-gray-200">
                                                @if($user->isSuperuser())
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-200 text-purple-800">
                                                        Superuser
                                                    </span>
                                                @else
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800' }}">
                                                        {{ ucfirst($user->role) }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="py-2 px-4 border-b border-gray-200">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                    {{ $user->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                    {{ ucfirst($user->status) }}
                                                </span>
                                            </td>
                                            <td class="py-2 px-4 border-b border-gray-200">
                                                <div class="flex space-x-2">
                                                    @can('update', $user)
                                                        <a href="{{ route('users.edit', $user) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                                                    @endcan

                                                    @can('softDelete', $user)
                                                        @if($user->status === 'active')
                                                            <form method="POST" action="{{ route('users.soft-delete', $user) }}" class="inline" onsubmit="return confirm('Are you sure you want to deactivate this user?');">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" class="text-yellow-600 hover:text-yellow-900">Deactivate</button>
                                                            </form>
                                                        @else
                                                            <form method="POST" action="{{ route('users.restore', $user) }}" class="inline" onsubmit="return confirm('Are you sure you want to reactivate this user?');">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" class="text-green-600 hover:text-green-900">Activate</button>
                                                            </form>
                                                        @endif
                                                    @endcan

                                                    @can('delete', $user)
                                                        <button type="button" class="text-red-600 hover:text-red-900" onclick="confirmDelete({{ $user->id }})">Delete</button>
                                                    @endcan

                                                    @cannot('update', $user)
                                                        @cannot('softDelete', $user)
                                                            @cannot('delete', $user)
                                                                <span class="text-gray-400">No actions available</span>
                                                            @endcannot
                                                        @endcannot
                                                    @endcannot
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="py-4 px-4 border-b border-gray-200 text-center">No users found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="py-4 px-4 border-b border-gray-200 text-center">
                            {{ __('No users found.') }}
                        </div>
                    @endif

                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50 items-center justify-center" x-data="{ open: false, userId: null }">
        <div class="relative mx-auto p-6 border w-[450px] shadow-lg rounded-md bg-white">
            <div class="mt-2 text-center">
                <h3 class="text-xl leading-6 font-medium text-gray-900">Confirm Permanent Deletion</h3>
                <div class="mt-5 px-2 py-3">
                    <p class="text-sm text-gray-600">
                        This action cannot be undone. Please enter your password to confirm.
                    </p>
                    <form id="deleteForm" method="POST" class="mt-6">
                        @csrf
                        @method('DELETE')
                        <div class="mb-6">
                            <label for="password" class="block text-left text-sm font-medium text-gray-700 mb-2">Your password</label>
                            <input type="password" name="password" id="password"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 py-2 px-3"
                                required>
                        </div>
                        <div class="flex justify-between mt-6">
                            <button type="button" onclick="closeDeleteModal()" class="px-6 py-3 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                                Cancel
                            </button>
                            <button type="submit" class="px-6 py-3 bg-red-600 text-white rounded-md hover:bg-red-700">
                                Delete Permanently
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(userId) {
            // Set the form action
            document.getElementById('deleteForm').action = `/users/${userId}`;

            // Show the modal
            const modal = document.getElementById('deleteModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            // Focus on the password field
            setTimeout(() => {
                document.getElementById('password').focus();
            }, 100);
        }

        function closeDeleteModal() {
            // Hide the modal
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');

            // Clear the password field
            document.getElementById('password').value = '';
        }

        document.addEventListener('DOMContentLoaded', function() {
            const filterToggle = document.getElementById('filter-toggle');
            const filterSection = document.getElementById('filter-section');

            filterToggle.addEventListener('click', function() {
                filterSection.classList.toggle('hidden');
            });
        });
    </script>
</x-app-layout>
