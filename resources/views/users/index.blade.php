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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
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
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800' }}">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </td>
                                        <td class="py-2 px-4 border-b border-gray-200">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                {{ $user->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ ucfirst($user->status) }}
                                            </span>
                                        </td>
                                        <td class="py-2 px-4 border-b border-gray-200">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('users.edit', $user) }}" class="text-blue-600 hover:text-blue-900">Edit</a>

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

                                                <button type="button" class="text-red-600 hover:text-red-900" onclick="confirmDelete({{ $user->id }})">Delete</button>
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
    </script>
</x-app-layout>
