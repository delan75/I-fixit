<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('User Details') }}
            </h2>
            <div>
                <a href="{{ route('users.edit', $user) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Edit User') }}
                </a>
                <a href="{{ route('users.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 ml-2">
                    {{ __('Back to List') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">User Information</h3>
                            <div class="mt-4 space-y-4">
                                <div>
                                    <span class="text-gray-500">Name:</span>
                                    <span class="ml-2 text-gray-900">{{ $user->name }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-500">Email:</span>
                                    <span class="ml-2 text-gray-900">{{ $user->email }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-500">Phone:</span>
                                    <span class="ml-2 text-gray-900">{{ $user->phone }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-500">Role:</span>
                                    @if($user->isSuperuser())
                                        <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-200 text-purple-800">
                                            Superuser
                                        </span>
                                    @else
                                        <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800' }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    @endif
                                </div>
                                <div>
                                    <span class="text-gray-500">Status:</span>
                                    <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ ucfirst($user->status) }}
                                    </span>
                                </div>
                                <div>
                                    <span class="text-gray-500">Created:</span>
                                    <span class="ml-2 text-gray-900">{{ $user->created_at->format('M d, Y H:i') }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-500">Last Updated:</span>
                                    <span class="ml-2 text-gray-900">{{ $user->updated_at->format('M d, Y H:i') }}</span>
                                </div>
                            </div>
                        </div>

                        @if(Auth::user()->hasAdminAccess())
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">User Actions</h3>
                            <div class="mt-4 space-y-4">
                                @if($user->status === 'active')
                                <form method="POST" action="{{ route('users.soft-delete', $user) }}" class="inline" onsubmit="return confirm('Are you sure you want to deactivate this user?');">
                                    @csrf
                                    @method('PUT')
                                    <x-danger-button>
                                        {{ __('Deactivate User') }}
                                    </x-danger-button>
                                </form>
                                @else
                                <form method="POST" action="{{ route('users.restore', $user) }}" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <x-primary-button>
                                        {{ __('Activate User') }}
                                    </x-primary-button>
                                </form>
                                @endif

                                <form method="POST" action="{{ route('users.destroy', $user) }}" class="inline mt-4" onsubmit="return confirm('Are you sure you want to permanently delete this user? This action cannot be undone.');">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button>
                                        {{ __('Permanently Delete User') }}
                                    </x-danger-button>
                                </form>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
