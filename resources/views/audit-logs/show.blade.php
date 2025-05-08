<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Audit Log Details') }}
            </h2>
            <a href="{{ route('audit-logs.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Back to List') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Basic Information') }}</h3>
                            <div class="space-y-4">
                                <div>
                                    <span class="text-gray-500">{{ __('ID:') }}</span>
                                    <span class="ml-2 text-gray-900">{{ $auditLog->id }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-500">{{ __('Date & Time:') }}</span>
                                    <span class="ml-2 text-gray-900">{{ $auditLog->created_at->format('M d, Y H:i:s') }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-500">{{ __('User:') }}</span>
                                    <span class="ml-2 text-gray-900">
                                        @if ($auditLog->user)
                                            {{ $auditLog->user->name }}
                                        @else
                                            <span class="text-gray-500">{{ __('System') }}</span>
                                        @endif
                                    </span>
                                </div>
                                <div>
                                    <span class="text-gray-500">{{ __('Action:') }}</span>
                                    <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if ($auditLog->action === 'created') bg-green-100 text-green-800
                                        @elseif ($auditLog->action === 'updated') bg-blue-100 text-blue-800
                                        @elseif ($auditLog->action === 'deleted') bg-red-100 text-red-800
                                        @elseif ($auditLog->action === 'soft_deleted') bg-yellow-100 text-yellow-800
                                        @elseif ($auditLog->action === 'restored') bg-purple-100 text-purple-800
                                        @elseif ($auditLog->action === 'login') bg-indigo-100 text-indigo-800
                                        @elseif ($auditLog->action === 'logout') bg-gray-100 text-gray-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        {{ ucfirst(str_replace('_', ' ', $auditLog->action)) }}
                                    </span>
                                </div>
                                <div>
                                    <span class="text-gray-500">{{ __('Model Type:') }}</span>
                                    <span class="ml-2 text-gray-900">{{ class_basename($auditLog->model_type) }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-500">{{ __('Model ID:') }}</span>
                                    <span class="ml-2 text-gray-900">{{ $auditLog->model_id }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-500">{{ __('IP Address:') }}</span>
                                    <span class="ml-2 text-gray-900">{{ $auditLog->ip_address }}</span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Changes') }}</h3>
                            
                            @if ($auditLog->old_values)
                                <div class="mb-4">
                                    <h4 class="text-md font-medium text-gray-700 mb-2">{{ __('Old Values') }}</h4>
                                    <div class="bg-gray-50 p-4 rounded-lg overflow-x-auto">
                                        <pre class="text-sm text-gray-700">{{ json_encode($auditLog->old_values, JSON_PRETTY_PRINT) }}</pre>
                                    </div>
                                </div>
                            @endif

                            @if ($auditLog->new_values)
                                <div>
                                    <h4 class="text-md font-medium text-gray-700 mb-2">{{ __('New Values') }}</h4>
                                    <div class="bg-gray-50 p-4 rounded-lg overflow-x-auto">
                                        <pre class="text-sm text-gray-700">{{ json_encode($auditLog->new_values, JSON_PRETTY_PRINT) }}</pre>
                                    </div>
                                </div>
                            @endif

                            @if (!$auditLog->old_values && !$auditLog->new_values)
                                <div class="text-gray-500">{{ __('No detailed changes recorded for this action.') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
