<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add Labor') }} - {{ $car->make }} {{ $car->model }} ({{ $car->year }})
            </h2>
            <a href="{{ route('cars.show', $car) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Back to Car') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('labor.store', $car) }}">
                        @csrf

                        <!-- Service Type -->
                        <div class="mb-4">
                            <x-input-label for="service_type" :value="__('Service Type')" />
                            <x-text-input id="service_type" class="block mt-1 w-full" type="text" name="service_type" :value="old('service_type')" required autofocus />
                            <x-input-error :messages="$errors->get('service_type')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Provider Name -->
                            <div class="mb-4">
                                <x-input-label for="provider_name" :value="__('Provider Name')" />
                                <x-text-input id="provider_name" class="block mt-1 w-full" type="text" name="provider_name" :value="old('provider_name')" required />
                                <x-input-error :messages="$errors->get('provider_name')" class="mt-2" />
                            </div>

                            <!-- Provider Contact -->
                            <div class="mb-4">
                                <x-input-label for="provider_contact" :value="__('Provider Contact')" />
                                <x-text-input id="provider_contact" class="block mt-1 w-full" type="text" name="provider_contact" :value="old('provider_contact')" />
                                <x-input-error :messages="$errors->get('provider_contact')" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Hours -->
                            <div class="mb-4">
                                <x-input-label for="hours" :value="__('Hours')" />
                                <x-text-input id="hours" class="block mt-1 w-full" type="number" name="hours" :value="old('hours')" min="0" step="0.5" />
                                <x-input-error :messages="$errors->get('hours')" class="mt-2" />
                            </div>

                            <!-- Hourly Rate -->
                            <div class="mb-4">
                                <x-input-label for="hourly_rate" :value="__('Hourly Rate (R)')" />
                                <x-text-input id="hourly_rate" class="block mt-1 w-full" type="number" name="hourly_rate" :value="old('hourly_rate')" min="0" step="0.01" />
                                <x-input-error :messages="$errors->get('hourly_rate')" class="mt-2" />
                            </div>

                            <!-- Total Cost -->
                            <div class="mb-4">
                                <x-input-label for="total_cost" :value="__('Total Cost (R)')" />
                                <x-text-input id="total_cost" class="block mt-1 w-full" type="number" name="total_cost" :value="old('total_cost', 0)" min="0" step="0.01" required />
                                <x-input-error :messages="$errors->get('total_cost')" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Service Date -->
                            <div class="mb-4">
                                <x-input-label for="service_date" :value="__('Service Date')" />
                                <x-text-input id="service_date" class="block mt-1 w-full" type="date" name="service_date" :value="old('service_date', date('Y-m-d'))" required />
                                <x-input-error :messages="$errors->get('service_date')" class="mt-2" />
                            </div>

                            <!-- Completion Date -->
                            <div class="mb-4">
                                <x-input-label for="completion_date" :value="__('Completion Date')" />
                                <x-text-input id="completion_date" class="block mt-1 w-full" type="date" name="completion_date" :value="old('completion_date')" />
                                <x-input-error :messages="$errors->get('completion_date')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-3">
                                {{ __('Add Labor') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto-calculate total cost when hours or hourly rate changes
        document.addEventListener('DOMContentLoaded', function() {
            const hoursInput = document.getElementById('hours');
            const hourlyRateInput = document.getElementById('hourly_rate');
            const totalCostInput = document.getElementById('total_cost');

            function calculateTotalCost() {
                const hours = parseFloat(hoursInput.value) || 0;
                const hourlyRate = parseFloat(hourlyRateInput.value) || 0;
                const totalCost = hours * hourlyRate;
                
                if (hours > 0 && hourlyRate > 0) {
                    totalCostInput.value = totalCost.toFixed(2);
                }
            }

            hoursInput.addEventListener('input', calculateTotalCost);
            hourlyRateInput.addEventListener('input', calculateTotalCost);
        });
    </script>
</x-app-layout>
