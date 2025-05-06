<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Supplier Details') }}: {{ $supplier->name }}
            </h2>
            <div class="flex space-x-2">
                    <a href="{{ route('suppliers.edit', $supplier) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        {{ __('Edit Supplier') }}
                    </a>

                    <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" class="inline" onsubmit="return confirm('{{ Auth::user()->role === 'admin' ? 'Are you sure you want to permanently delete this supplier?' : 'Are you sure you want to mark this supplier as inactive?' }}');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            {{ Auth::user()->role === 'admin' ? __('Delete') : __('Deactivate') }}
                        </button>
                    </form>
                <a href="{{ route('suppliers.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    {{ __('Back to Suppliers') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Supplier Details -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-flash-message />

                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900">{{ __('Supplier Information') }}</h3>
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

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <div class="space-y-4">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">{{ __('Name') }}</h4>
                                    <p class="mt-1 text-sm text-gray-900">{{ $supplier->name }}</p>
                                </div>

                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">{{ __('Branch') }}</h4>
                                    <p class="mt-1 text-sm text-gray-900">{{ $supplier->branch_name ?? 'N/A' }}</p>
                                </div>

                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">{{ __('Contact Person') }}</h4>
                                    <p class="mt-1 text-sm text-gray-900">{{ $supplier->contact_person ?? 'N/A' }}</p>
                                </div>

                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">{{ __('Phone') }}</h4>
                                    <p class="mt-1 text-sm text-gray-900">{{ $supplier->phone ?? 'N/A' }}</p>
                                </div>

                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">{{ __('Email') }}</h4>
                                    <p class="mt-1 text-sm text-gray-900">{{ $supplier->email ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="space-y-4">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">{{ __('Website') }}</h4>
                                    <p class="mt-1 text-sm text-gray-900">
                                        @if($supplier->website)
                                            <a href="{{ $supplier->website }}" target="_blank" class="text-green-600 hover:text-green-700">{{ $supplier->website }}</a>
                                        @else
                                            N/A
                                        @endif
                                    </p>
                                </div>

                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">{{ __('Address') }}</h4>
                                    <p class="mt-1 text-sm text-gray-900 whitespace-pre-line">{{ $supplier->address ?? 'N/A' }}</p>
                                </div>

                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">{{ __('Notes') }}</h4>
                                    <p class="mt-1 text-sm text-gray-900 whitespace-pre-line">{{ $supplier->notes ?? 'N/A' }}</p>
                                </div>

                                @if(Auth::user()->role === 'admin' || Auth::id() === $supplier->created_by)
                                <div class="mt-6 pt-6 border-t border-gray-200">
                                    <h4 class="text-sm font-medium text-gray-500">{{ __('Record Information') }}</h4>
                                    <div class="mt-2 grid grid-cols-1 gap-2 text-xs text-gray-500">
                                        @if($supplier->creator)
                                        <div class="flex items-center">
                                            <span class="font-medium mr-1">{{ __('Created by:') }}</span>
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                {{ $supplier->creator->name }}
                                            </span>
                                        </div>
                                        @endif
                                        <div>
                                            <span class="font-medium mr-1">{{ __('Created at:') }}</span>
                                            {{ $supplier->created_at->format('M d, Y H:i') }}
                                        </div>
                                        @if($supplier->updater && $supplier->updated_at->gt($supplier->created_at))
                                        <div class="flex items-center">
                                            <span class="font-medium mr-1">{{ __('Last updated by:') }}</span>
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                                {{ $supplier->updater->name }}
                                            </span>
                                        </div>
                                        <div>
                                            <span class="font-medium mr-1">{{ __('Last updated at:') }}</span>
                                            {{ $supplier->updated_at->format('M d, Y H:i') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Parts Supplied -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900">{{ __('Parts Supplied') }}</h3>
                    </div>

                    @if($supplier->parts->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Part Name') }}</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Car') }}</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Condition') }}</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Quantity') }}</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Unit Price') }}</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Total Price') }}</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Purchase Date') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($supplier->parts as $part)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $part->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <a href="{{ route('cars.show', $part->car) }}" class="text-green-600 hover:text-green-700">
                                                    {{ $part->car->year }} {{ $part->car->make }} {{ $part->car->model }}
                                                </a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ ucfirst($part->condition) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $part->quantity }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">R {{ number_format($part->unit_price, 2) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">R {{ number_format($part->total_price, 2) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $part->purchase_date->format('d M Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="bg-gray-50">
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-right">{{ __('Total:') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">R {{ number_format($supplier->parts->sum('total_price'), 2) }}</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    @else
                        <div class="py-8 flex flex-col items-center justify-center text-center">
                            <div class="bg-gray-100 p-3 rounded-full mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <h4 class="text-lg font-medium text-gray-900 mb-2">{{ __('No parts supplied') }}</h4>
                            <p class="text-gray-600 mb-4">{{ __('This supplier hasn\'t supplied any parts yet.') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
