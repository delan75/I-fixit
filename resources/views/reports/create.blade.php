<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Generate Report') }}: {{ $reportType->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('reports.store') }}" x-data="{ dateRange: 'last_30_days' }">
                        @csrf
                        <input type="hidden" name="report_type_id" value="{{ $reportType->id }}">

                        <!-- Report Title -->
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">{{ __('Report Title') }}</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $reportType->name . ' - ' . now()->format('M d, Y')) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('title')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Date Range -->
                        <div class="mb-4">
                            <label for="date_range" class="block text-sm font-medium text-gray-700">{{ __('Date Range') }}</label>
                            <select name="date_range" id="date_range" x-model="dateRange" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @foreach ($dateRanges as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('date_range')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Custom Date Range -->
                        <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4" x-show="dateRange === 'custom'">
                            <div>
                                <label for="start_date" class="block text-sm font-medium text-gray-700">{{ __('Start Date') }}</label>
                                <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                @error('start_date')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="end_date" class="block text-sm font-medium text-gray-700">{{ __('End Date') }}</label>
                                <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                @error('end_date')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Filters -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">{{ __('Filters') }}</h3>

                            <!-- Car Selection -->
                            <div class="mb-6 border border-gray-200 rounded-lg p-4 bg-gray-50">
                                <h4 class="text-md font-medium text-gray-900 mb-3">{{ __('Select Specific Cars') }}</h4>
                                <p class="text-sm text-gray-600 mb-4">{{ __('You can select specific cars for your report, or use the filters below to generate a report based on criteria.') }}</p>

                                <div x-data="carSelector()" class="mb-4">
                                    <div class="flex flex-col space-y-2">
                                        <label class="block text-sm font-medium text-gray-700">{{ __('Search and select cars') }}</label>

                                        <div class="relative">
                                            <input
                                                type="text"
                                                x-model="searchTerm"
                                                x-on:input="searchCars()"
                                                x-on:click="isOpen = true"
                                                x-on:keydown.escape="isOpen = false"
                                                placeholder="Search by make, model, year, or color..."
                                                class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500"
                                            >

                                            <div
                                                x-show="isOpen"
                                                x-on:click.away="isOpen = false"
                                                class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg max-h-60 overflow-y-auto"
                                                style="display: none;"
                                            >
                                                <div x-show="filteredCars.length === 0" class="px-4 py-3 text-sm text-gray-500">
                                                    No cars found
                                                </div>
                                                <template x-for="car in filteredCars" :key="car.id">
                                                    <div
                                                        x-on:click="selectCar(car)"
                                                        class="px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                                                    >
                                                        <span x-text="car.year + ' ' + car.make + ' ' + car.model + ' ' + car.color"></span>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>

                                        <div class="mt-3">
                                            <h5 class="text-sm font-medium text-gray-700 mb-2">{{ __('Selected Cars') }}</h5>
                                            <div x-show="selectedCars.length === 0" class="text-sm text-gray-500 italic">
                                                No cars selected
                                            </div>
                                            <div class="flex flex-wrap gap-2">
                                                <template x-for="car in selectedCars" :key="car.id">
                                                    <div class="inline-flex items-center px-2.5 py-1.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        <span x-text="car.year + ' ' + car.make + ' ' + car.model + ' ' + car.color"></span>
                                                        <button type="button" x-on:click="removeCar(car)" class="ml-1.5 text-green-600 hover:text-green-900">
                                                            <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                                            </svg>
                                                        </button>
                                                        <input type="hidden" name="selected_cars[]" :value="car.id">
                                                    </div>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if(Auth::user()->hasAdminAccess() && count($users) > 0)
                                <div class="mt-4 pt-4 border-t border-gray-200">
                                    <label for="selected_user_id" class="block text-sm font-medium text-gray-700">{{ __('Generate report for specific user') }}</label>
                                    <select name="selected_user_id" id="selected_user_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                        <option value="">{{ __('All Users') }}</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" {{ old('selected_user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                                        @endforeach
                                    </select>
                                    <p class="mt-1 text-xs text-gray-500">{{ __('As an admin, you can generate reports for cars belonging to a specific user.') }}</p>
                                </div>
                                @endif
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                <!-- Make Filter -->
                                <div>
                                    <label for="make" class="block text-sm font-medium text-gray-700">{{ __('Make') }}</label>
                                    <select name="make" id="make" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                        <option value="">{{ __('All Makes') }}</option>
                                        @foreach ($makes as $make)
                                            <option value="{{ $make }}" {{ old('make') == $make ? 'selected' : '' }}>{{ $make }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Year Filter -->
                                <div>
                                    <label for="year" class="block text-sm font-medium text-gray-700">{{ __('Year') }}</label>
                                    <select name="year" id="year" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                        <option value="">{{ __('All Years') }}</option>
                                        @foreach ($years as $year)
                                            <option value="{{ $year }}" {{ old('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Phase Filter -->
                                <div>
                                    <label for="phase" class="block text-sm font-medium text-gray-700">{{ __('Phase') }}</label>
                                    <select name="phase" id="phase" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                        <option value="">{{ __('All Phases') }}</option>
                                        @foreach ($phases as $phase)
                                            <option value="{{ $phase }}" {{ old('phase') == $phase ? 'selected' : '' }}>{{ ucfirst($phase) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end">
                            <a href="{{ route('reports.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-400 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 mr-2">
                                {{ __('Cancel') }}
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-800 focus:outline-none focus:border-green-800 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                                <i class="fas fa-chart-line mr-2"></i>{{ __('Generate Report') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@push('scripts')
<script>
    function carSelector() {
        return {
            searchTerm: '',
            isOpen: false,
            selectedCars: [],
            filteredCars: [],
            allCars: {!! json_encode($cars->map(function($car) {
                return [
                    'id' => $car->id,
                    'make' => $car->make,
                    'model' => $car->model,
                    'year' => $car->year,
                    'color' => $car->color ?? 'Unknown',
                    'vin' => $car->vin,
                    'registration' => $car->registration_number
                ];
            })) !!},

            searchCars() {
                if (this.searchTerm.trim() === '') {
                    this.filteredCars = [];
                    return;
                }

                const term = this.searchTerm.toLowerCase();
                this.filteredCars = this.allCars.filter(car => {
                    // Don't show cars that are already selected
                    if (this.selectedCars.some(selected => selected.id === car.id)) {
                        return false;
                    }

                    // Search by make, model, year, color, VIN, or registration
                    return car.make.toLowerCase().includes(term) ||
                           car.model.toLowerCase().includes(term) ||
                           car.year.toString().includes(term) ||
                           car.color.toLowerCase().includes(term) ||
                           (car.vin && car.vin.toLowerCase().includes(term)) ||
                           (car.registration && car.registration.toLowerCase().includes(term));
                }).slice(0, 10); // Limit to 10 results for performance
            },

            selectCar(car) {
                if (!this.selectedCars.some(selected => selected.id === car.id)) {
                    this.selectedCars.push(car);
                }
                this.searchTerm = '';
                this.filteredCars = [];
                this.isOpen = false;
            },

            removeCar(car) {
                this.selectedCars = this.selectedCars.filter(selected => selected.id !== car.id);
            }
        };
    }
</script>
@endpush

</x-app-layout>
