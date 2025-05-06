<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Audit Logs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Filters -->
                    <div class="mb-6 bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-700 mb-2">{{ __('Filter Logs') }}</h3>
                        <form method="GET" action="{{ route('audit-logs.index') }}" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div>
                                <x-input-label for="user_id" :value="__('User')" />
                                <select id="user_id" name="user_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="">{{ __('All Users') }}</option>
                                    @foreach($users as $user)
                                        @if($user)
                                            <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <x-input-label for="action" :value="__('Action')" />
                                <select id="action" name="action" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="">{{ __('All Actions') }}</option>
                                    @foreach($actions as $action)
                                        <option value="{{ $action }}" {{ request('action') == $action ? 'selected' : '' }}>
                                            {{ ucfirst(str_replace('_', ' ', $action)) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <x-input-label for="model_type" :value="__('Model Type')" />
                                <select id="model_type" name="model_type" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="">{{ __('All Types') }}</option>
                                    @foreach($modelTypes as $type)
                                        <option value="{{ $type }}" {{ request('model_type') == $type ? 'selected' : '' }}>
                                            {{ class_basename($type) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <x-input-label for="date_from" :value="__('Date From')" />
                                <x-text-input id="date_from" class="block mt-1 w-full" type="date" name="date_from" :value="request('date_from')" />
                            </div>

                            <div>
                                <x-input-label for="date_to" :value="__('Date To')" />
                                <x-text-input id="date_to" class="block mt-1 w-full" type="date" name="date_to" :value="request('date_to')" />
                            </div>

                            <div class="md:col-span-2 lg:col-span-4 flex items-end">
                                <x-primary-button>
                                    {{ __('Filter') }}
                                </x-primary-button>
                                <a href="{{ route('audit-logs.index') }}" class="ml-3 inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    {{ __('Reset') }}
                                </a>
                            </div>
                        </form>
                    </div>

                    <!-- Audit Logs Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">{{ __('Date & Time') }}</th>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">{{ __('User') }}</th>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">{{ __('Action') }}</th>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">{{ __('Model') }}</th>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">{{ __('Details') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($auditLogs as $log)
                                    <tr>
                                        <td class="py-2 px-4 border-b border-gray-200">{{ $log->created_at->format('M d, Y H:i:s') }}</td>
                                        <td class="py-2 px-4 border-b border-gray-200">
                                            @if ($log->user)
                                                {{ $log->user->name }}
                                            @else
                                                <span class="text-gray-500">{{ __('System') }}</span>
                                            @endif
                                        </td>
                                        <td class="py-2 px-4 border-b border-gray-200">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                @if ($log->action === 'created') bg-green-100 text-green-800
                                                @elseif ($log->action === 'updated') bg-blue-100 text-blue-800
                                                @elseif ($log->action === 'deleted') bg-red-100 text-red-800
                                                @elseif ($log->action === 'soft_deleted') bg-yellow-100 text-yellow-800
                                                @elseif ($log->action === 'restored') bg-purple-100 text-purple-800
                                                @elseif ($log->action === 'login') bg-indigo-100 text-indigo-800
                                                @elseif ($log->action === 'logout') bg-gray-100 text-gray-800
                                                @else bg-gray-100 text-gray-800
                                                @endif">
                                                {{ ucfirst(str_replace('_', ' ', $log->action)) }}
                                            </span>
                                        </td>
                                        <td class="py-2 px-4 border-b border-gray-200">
                                            {{ class_basename($log->model_type) }} #{{ $log->model_id }}
                                        </td>
                                        <td class="py-2 px-4 border-b border-gray-200">
                                            <a href="{{ route('audit-logs.show', $log) }}" class="text-blue-600 hover:text-blue-900">{{ __('View Details') }}</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-4 px-4 border-b border-gray-200 text-center text-gray-500">{{ __('No audit logs found.') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $auditLogs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
