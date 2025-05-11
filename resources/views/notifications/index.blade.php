<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notifications') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-gray-900">{{ __('Your Notifications') }}</h3>
                        
                        @if ($unreadCount > 0)
                            <form action="{{ route('notifications.mark-all-as-read') }}" method="POST">
                                @csrf
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    {{ __('Mark All as Read') }}
                                </button>
                            </form>
                        @endif
                    </div>

                    @if ($notifications->count() > 0)
                        <div class="space-y-4">
                            @foreach ($notifications as $notification)
                                <div class="p-4 rounded-lg border {{ $notification->is_read ? 'bg-gray-50 border-gray-200' : 'bg-blue-50 border-blue-200' }}">
                                    <div class="flex items-start">
                                        @if ($notification->icon)
                                            <div class="mr-3 text-xl {{ $notification->is_read ? 'text-gray-500' : 'text-blue-500' }}">
                                                <i class="fas {{ $notification->icon }}"></i>
                                            </div>
                                        @endif
                                        
                                        <div class="flex-1">
                                            <div class="flex justify-between items-start">
                                                <h4 class="text-md font-medium {{ $notification->is_read ? 'text-gray-700' : 'text-blue-700' }}">
                                                    {{ $notification->title }}
                                                </h4>
                                                <span class="text-xs text-gray-500">
                                                    {{ $notification->created_at->diffForHumans() }}
                                                </span>
                                            </div>
                                            
                                            <p class="mt-1 text-sm {{ $notification->is_read ? 'text-gray-600' : 'text-blue-600' }}">
                                                {{ $notification->message }}
                                            </p>
                                            
                                            <div class="mt-2 flex justify-between items-center">
                                                @if ($notification->link)
                                                    <a href="{{ $notification->link }}" class="text-sm text-indigo-600 hover:text-indigo-900">
                                                        {{ __('View Details') }}
                                                    </a>
                                                @else
                                                    <span></span>
                                                @endif
                                                
                                                @if (!$notification->is_read)
                                                    <form action="{{ route('notifications.mark-as-read', $notification) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="text-sm text-gray-600 hover:text-gray-900">
                                                            {{ __('Mark as Read') }}
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-6">
                            {{ $notifications->links() }}
                        </div>
                    @else
                        <div class="text-center py-8">
                            <div class="text-gray-400 text-4xl mb-4">
                                <i class="fas fa-bell-slash"></i>
                            </div>
                            <p class="text-gray-600">{{ __('You have no notifications.') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
