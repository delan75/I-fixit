<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Audit Logs') }}
        </h2>
    </x-slot>

    <div class="py-12">
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
                    <form method="GET" action="{{ route('audit-logs.index') }}">
                        <div class="flex flex-col lg:flex-row lg:items-end lg:space-x-4 space-y-4 lg:space-y-0">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 flex-grow">
                                <div>
                                    <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1">{{ __('User') }}</label>
                                    <select id="user_id" name="user_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
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
                                    <label for="action" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Action') }}</label>
                                    <select id="action" name="action" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                        <option value="">{{ __('All Actions') }}</option>
                                        @foreach($actions as $action)
                                            <option value="{{ $action }}" {{ request('action') == $action ? 'selected' : '' }}>
                                                {{ ucfirst(str_replace('_', ' ', $action)) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label for="model_type" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Model Type') }}</label>
                                    <select id="model_type" name="model_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                        <option value="">{{ __('All Types') }}</option>
                                        @foreach($modelTypes as $type)
                                            <option value="{{ $type }}" {{ request('model_type') == $type ? 'selected' : '' }}>
                                                {{ class_basename($type) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label for="date_from" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Date From') }}</label>
                                    <input type="date" id="date_from" name="date_from" value="{{ request('date_from') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                </div>

                                <div>
                                    <label for="date_to" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Date To') }}</label>
                                    <input type="date" id="date_to" name="date_to" value="{{ request('date_to') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                </div>
                            </div>
                            <div class="flex-shrink-0 flex space-x-3">
                                <a href="{{ route('audit-logs.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    {{ __('Reset') }}
                                </a>
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterToggle = document.getElementById('filter-toggle');
            const filterSection = document.getElementById('filter-section');

            filterToggle.addEventListener('click', function() {
                filterSection.classList.toggle('hidden');
            });
        });
    </script>
</x-app-layout>
