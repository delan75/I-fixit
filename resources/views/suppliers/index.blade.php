<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Suppliers') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('suppliers.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    {{ __('Add New Supplier') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-4">
            <!-- Filter Toggle Button -->
            <div class="flex justify-end items-center mb-6">
                <button id="filter-toggle" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 min-h-[44px] min-w-[44px]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    <span class="hidden sm:inline">{{ __('Filter & Search') }}</span>
                    <span class="sm:hidden">{{ __('Filter') }}</span>
                </button>
            </div>

            <!-- Filters and Search -->
            <div id="filter-section" class="hidden bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('suppliers.index') }}" method="GET">
                        <div class="flex flex-col lg:flex-row lg:items-end lg:space-x-4 space-y-4 lg:space-y-0">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 flex-grow">
                                <!-- Search Bar -->
                                <div>
                                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Search') }}</label>
                                    <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Search by name, branch, contact person, phone or email..."
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                </div>

                                <!-- Created By Filter -->
                                <div>
                                    <label for="created_by" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Created By') }}</label>
                                    <select id="created_by" name="created_by" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                        <option value="">{{ __('All Creators') }}</option>
                                        @foreach($creators as $creator)
                                            <option value="{{ $creator->id }}" {{ request('created_by') == $creator->id ? 'selected' : '' }}>{{ $creator->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Status Filter (Admin/Superuser Only) -->
                                @if(Auth::user()->hasAdminAccess())
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Status') }}</label>
                                    <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                        <option value="">{{ __('All Statuses') }}</option>
                                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>{{ __('Active') }}</option>
                                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>{{ __('Inactive') }}</option>
                                    </select>
                                </div>
                                @endif
                            </div>
                            <div class="flex-shrink-0">
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

            <!-- Suppliers List -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-flash-message />

                    @if($suppliers->count() > 0)
                        <!-- Desktop Table View -->
                        <div class="hidden md:block overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Name') }}</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Branch') }}</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Contact Person') }}</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Phone') }}</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Email') }}</th>
                                        @if(Auth::user()->hasAdminAccess())
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Status') }}</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Created By') }}</th>
                                        @endif
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($suppliers as $supplier)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">{{ $supplier->name }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">{{ $supplier->branch_name ?? 'N/A' }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">{{ $supplier->contact_person ?? 'N/A' }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">{{ $supplier->phone ?? 'N/A' }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">{{ $supplier->email ?? 'N/A' }}</div>
                                            </td>
                                            @if(Auth::user()->hasAdminAccess())
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm">
                                                    @if($supplier->status === 'active')
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                            {{ __('Active') }}
                                                        </span>
                                                    @else
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                            {{ __('Inactive') }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($supplier->creator)
                                                    <div class="text-sm text-gray-500">
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                            {{ $supplier->creator->name }}
                                                        </span>
                                                    </div>
                                                @else
                                                    <div class="text-sm text-gray-500">{{ __('System') }}</div>
                                                @endif
                                            </td>
                                            @endif
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('suppliers.show', $supplier) }}" class="text-green-600 hover:text-green-900 min-h-[44px] min-w-[44px] flex items-center justify-center">{{ __('View') }}</a>
                                                    <a href="{{ route('suppliers.edit', $supplier) }}" class="text-blue-600 hover:text-blue-900 min-h-[44px] min-w-[44px] flex items-center justify-center">{{ __('Edit') }}</a>

                                                    @if($supplier->status === 'active')
                                                        <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" class="inline" onsubmit="return confirm('{{ Auth::user()->hasAdminAccess() ? 'Are you sure you want to permanently delete this supplier?' : 'Are you sure you want to mark this supplier as inactive?' }}');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-red-600 hover:text-red-900 min-h-[44px] min-w-[44px] flex items-center justify-center">
                                                                {{ Auth::user()->hasAdminAccess() ? __('Delete') : __('Delete') }}
                                                            </button>
                                                        </form>
                                                    @elseif(Auth::user()->hasAdminAccess() && $supplier->status === 'inactive')
                                                        <form action="{{ route('suppliers.restore', $supplier) }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="text-green-600 hover:text-green-900 min-h-[44px] min-w-[44px] flex items-center justify-center">
                                                                {{ __('Reactivate') }}
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Mobile Card View -->
                        <div class="md:hidden space-y-4">
                            @foreach($suppliers as $supplier)
                                <div class="bg-white rounded-lg shadow-md p-4 border border-gray-200">
                                    <div class="flex justify-between items-start mb-2">
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $supplier->name }}</h3>
                                        @if(Auth::user()->hasAdminAccess())
                                            @if($supplier->status === 'active')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    {{ __('Active') }}
                                                </span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    {{ __('Inactive') }}
                                                </span>
                                            @endif
                                        @endif
                                    </div>

                                    <div class="space-y-2 mb-4">
                                        @if($supplier->branch_name)
                                            <div class="flex justify-between">
                                                <span class="text-sm font-medium text-gray-500">{{ __('Branch') }}:</span>
                                                <span class="text-sm text-gray-700">{{ $supplier->branch_name }}</span>
                                            </div>
                                        @endif

                                        @if($supplier->contact_person)
                                            <div class="flex justify-between">
                                                <span class="text-sm font-medium text-gray-500">{{ __('Contact') }}:</span>
                                                <span class="text-sm text-gray-700">{{ $supplier->contact_person }}</span>
                                            </div>
                                        @endif

                                        @if($supplier->phone)
                                            <div class="flex justify-between">
                                                <span class="text-sm font-medium text-gray-500">{{ __('Phone') }}:</span>
                                                <span class="text-sm text-gray-700">{{ $supplier->phone }}</span>
                                            </div>
                                        @endif

                                        @if($supplier->email)
                                            <div class="flex justify-between">
                                                <span class="text-sm font-medium text-gray-500">{{ __('Email') }}:</span>
                                                <span class="text-sm text-gray-700">{{ $supplier->email }}</span>
                                            </div>
                                        @endif

                                        @if(Auth::user()->hasAdminAccess() && $supplier->creator)
                                            <div class="flex justify-between">
                                                <span class="text-sm font-medium text-gray-500">{{ __('Created By') }}:</span>
                                                <span class="text-sm text-gray-700">{{ $supplier->creator->name }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="flex justify-between items-center pt-2 border-t border-gray-200">
                                        <a href="{{ route('suppliers.show', $supplier) }}" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150 min-h-[44px] min-w-[44px]">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('suppliers.edit', $supplier) }}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 min-h-[44px] min-w-[44px]">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        @if($supplier->status === 'active')
                                            <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" class="inline" onsubmit="return confirm('{{ Auth::user()->hasAdminAccess() ? 'Are you sure you want to permanently delete this supplier?' : 'Are you sure you want to mark this supplier as inactive?' }}');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150 min-h-[44px] min-w-[44px]">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @elseif(Auth::user()->hasAdminAccess() && $supplier->status === 'inactive')
                                            <form action="{{ route('suppliers.restore', $supplier) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150 min-h-[44px] min-w-[44px]">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4">
                            {{ $suppliers->links() }}
                        </div>
                    @else
                        <div class="py-8 flex flex-col items-center justify-center text-center">
                            <div class="bg-gray-100 p-3 rounded-full mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <h4 class="text-lg font-medium text-gray-900 mb-2">{{ __('No suppliers found') }}</h4>
                            @if(request('search'))
                                <p class="text-gray-600 mb-4">{{ __('No suppliers match your search criteria.') }}</p>
                                <a href="{{ route('suppliers.index') }}" class="text-sm text-green-600 hover:text-green-700">{{ __('Clear search') }}</a>
                            @else
                                <p class="text-gray-600 mb-4">{{ __('You haven\'t added any suppliers yet.') }}</p>
                                <a href="{{ route('suppliers.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    {{ __('Add New Supplier') }}
                                </a>
                            @endif
                        </div>
                    @endif
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
