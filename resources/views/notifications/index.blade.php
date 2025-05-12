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
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 space-y-4 md:space-y-0">
                        <h3 class="text-lg font-medium text-gray-900">{{ __('Your Notifications') }}</h3>

                        <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2">
                            <div class="flex space-x-2">
                                <a href="{{ route('notifications.index') }}" class="inline-flex items-center px-3 py-2 {{ request()->get('filter') === null ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700' }} border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-indigo-700 hover:text-white focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    {{ __('All') }}
                                </a>
                                <a href="{{ route('notifications.index', ['filter' => 'unread']) }}" class="inline-flex items-center px-3 py-2 {{ request()->get('filter') === 'unread' ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700' }} border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-indigo-700 hover:text-white focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    {{ __('Unread') }}
                                </a>
                                <a href="{{ route('notifications.index', ['filter' => 'read']) }}" class="inline-flex items-center px-3 py-2 {{ request()->get('filter') === 'read' ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700' }} border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-indigo-700 hover:text-white focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    {{ __('Read') }}
                                </a>
                            </div>

                            @if ($unreadCount > 0)
                                <form action="{{ route('notifications.mark-all-as-read') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                                        {{ __('Mark All as Read') }}
                                    </button>
                                </form>
                            @endif
                        </div>
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
