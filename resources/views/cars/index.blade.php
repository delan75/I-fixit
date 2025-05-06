<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Cars') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('cars.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    {{ __('Add New Car') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filters -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('cars.index') }}" method="GET" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div>
                                <label for="phase" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Phase') }}</label>
                                <select id="phase" name="phase" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                    <option value="">{{ __('All Phases') }}</option>
                                    <option value="bidding" {{ request('phase') == 'bidding' ? 'selected' : '' }}>{{ __('Bidding') }}</option>
                                    <option value="fixing" {{ request('phase') == 'fixing' ? 'selected' : '' }}>{{ __('Fixing') }}</option>
                                    <option value="dealership" {{ request('phase') == 'dealership' ? 'selected' : '' }}>{{ __('At Dealership') }}</option>
                                    <option value="sold" {{ request('phase') == 'sold' ? 'selected' : '' }}>{{ __('Sold') }}</option>
                                </select>
                            </div>
                            <div>
                                <label for="make" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Make') }}</label>
                                <select id="make" name="make" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                    <option value="">{{ __('All Makes') }}</option>
                                    @foreach($makes as $carMake)
                                        <option value="{{ $carMake }}" {{ request('make') == $carMake ? 'selected' : '' }}>{{ $carMake }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="model" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Model') }}</label>
                                <select id="model" name="model" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                    <option value="">{{ __('All Models') }}</option>
                                    @foreach($models as $carModel)
                                        <option value="{{ $carModel }}" {{ request('model') == $carModel ? 'selected' : '' }}>{{ $carModel }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="year" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Year') }}</label>
                                <select id="year" name="year" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                    <option value="">{{ __('All Years') }}</option>
                                    @foreach($years as $carYear)
                                        <option value="{{ $carYear }}" {{ request('year') == $carYear ? 'selected' : '' }}>{{ $carYear }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                </svg>
                                {{ __('Filter') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Cars List -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-flash-message />

                    @if($cars->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Car') }}</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Phase') }}</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Purchase Price') }}</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Purchase Date') }}</th>
                                        @if(Auth::user()->role === 'admin')
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Created By') }}</th>
                                        @endif
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($cars as $car)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ $car->year }} {{ $car->make }} {{ $car->model }} {{ $car->variant ?? '' }}
                                                        </div>
                                                        <div class="text-sm text-gray-500">{{ $car->vin ?? 'No VIN' }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                    @if($car->current_phase == 'bidding') bg-blue-100 text-blue-800
                                                    @elseif($car->current_phase == 'fixing') bg-yellow-100 text-yellow-800
                                                    @elseif($car->current_phase == 'dealership') bg-green-100 text-green-800
                                                    @elseif($car->current_phase == 'sold') bg-purple-100 text-purple-800
                                                    @endif">
                                                    {{ ucfirst($car->current_phase) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                R {{ number_format($car->purchase_price, 2) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $car->purchase_date->format('d M Y') }}
                                            </td>
                                            @if(Auth::user()->role === 'admin')
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                @if($car->creator)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                        {{ $car->creator->name }}
                                                    </span>
                                                @else
                                                    <span class="text-gray-400">{{ __('System') }}</span>
                                                @endif
                                            </td>
                                            @endif
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('cars.show', $car) }}" class="text-green-600 hover:text-green-900">{{ __('View') }}</a>
                                                    <a href="{{ route('cars.edit', $car) }}" class="text-blue-600 hover:text-blue-900">{{ __('Edit') }}</a>
                                                    <form action="{{ route('cars.destroy', $car) }}" method="POST" class="inline" onsubmit="return confirm('{{ Auth::user()->role === 'admin' ? 'Are you sure you want to permanently delete this car?' : 'Are you sure you want to mark this car as inactive?' }}');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                                            {{ Auth::user()->role === 'admin' ? __('Delete') : __('Deactivate') }}
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $cars->links() }}
                        </div>
                    @else
                        <div class="py-8 flex flex-col items-center justify-center text-center">
                            <div class="bg-gray-100 p-3 rounded-full mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                            <h4 class="text-lg font-medium text-gray-900 mb-2">{{ __('No cars found') }}</h4>
                            <p class="text-gray-600 mb-4">{{ __('No cars match your search criteria.') }}</p>
                            <a href="{{ route('cars.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Add New Car') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
