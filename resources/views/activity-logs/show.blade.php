<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Activity Log Details') }}
            </h2>
            <a href="{{ route('activity-logs.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Back to List') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Activity Information') }}</h3>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="mb-4">
                                    <h4 class="text-sm font-medium text-gray-500">{{ __('Activity Type') }}</h4>
                                    <p class="mt-1 text-sm text-gray-900">
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                            @if ($activityLog->activity_type === 'login') bg-green-100 text-green-800
                                            @elseif ($activityLog->activity_type === 'logout') bg-blue-100 text-blue-800
                                            @elseif ($activityLog->activity_type === 'create') bg-indigo-100 text-indigo-800
                                            @elseif ($activityLog->activity_type === 'update') bg-purple-100 text-purple-800
                                            @elseif ($activityLog->activity_type === 'delete') bg-red-100 text-red-800
                                            @elseif ($activityLog->activity_type === 'view') bg-yellow-100 text-yellow-800
                                            @else bg-gray-100 text-gray-800
                                            @endif">
                                            {{ ucfirst(str_replace('_', ' ', $activityLog->activity_type)) }}
                                        </span>
                                    </p>
                                </div>
                                <div class="mb-4">
                                    <h4 class="text-sm font-medium text-gray-500">{{ __('Description') }}</h4>
                                    <p class="mt-1 text-sm text-gray-900">{{ $activityLog->description }}</p>
                                </div>
                                <div class="mb-4">
                                    <h4 class="text-sm font-medium text-gray-500">{{ __('Date & Time') }}</h4>
                                    <p class="mt-1 text-sm text-gray-900">{{ $activityLog->created_at->format('F d, Y H:i:s') }}</p>
                                </div>
                                <div class="mb-4">
                                    <h4 class="text-sm font-medium text-gray-500">{{ __('IP Address') }}</h4>
                                    <p class="mt-1 text-sm text-gray-900">{{ $activityLog->ip_address ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">{{ __('User Agent') }}</h4>
                                    <p class="mt-1 text-sm text-gray-900 break-words">{{ $activityLog->user_agent ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Related Information') }}</h3>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="mb-4">
                                    <h4 class="text-sm font-medium text-gray-500">{{ __('User') }}</h4>
                                    <p class="mt-1 text-sm text-gray-900">
                                        @if ($activityLog->user)
                                            <a href="{{ route('users.show', $activityLog->user) }}" class="text-blue-600 hover:text-blue-900">
                                                {{ $activityLog->user->name }}
                                            </a>
                                        @else
                                            <span class="text-gray-500">{{ __('System') }}</span>
                                        @endif
                                    </p>
                                </div>
                                @if ($activityLog->model_type)
                                <div class="mb-4">
                                    <h4 class="text-sm font-medium text-gray-500">{{ __('Resource Type') }}</h4>
                                    <p class="mt-1 text-sm text-gray-900">{{ class_basename($activityLog->model_type) }}</p>
                                </div>
                                @endif
                                @if ($activityLog->model_id)
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">{{ __('Resource ID') }}</h4>
                                    <p class="mt-1 text-sm text-gray-900">{{ $activityLog->model_id }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
