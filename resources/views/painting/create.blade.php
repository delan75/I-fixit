<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add Painting') }} - {{ $car->make }} {{ $car->model }} ({{ $car->year }})
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
                    <form method="POST" action="{{ route('painting.store', $car) }}">
                        @csrf

                        <!-- Painting Type -->
                        <div class="mb-4">
                            <x-input-label for="painting_type" :value="__('Painting Type')" />
                            <select id="painting_type" name="painting_type" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                                <option value="">{{ __('Select Type') }}</option>
                                <option value="full" {{ old('painting_type') == 'full' ? 'selected' : '' }}>{{ __('Full') }}</option>
                                <option value="partial" {{ old('painting_type') == 'partial' ? 'selected' : '' }}>{{ __('Partial') }}</option>
                            </select>
                            <x-input-error :messages="$errors->get('painting_type')" class="mt-2" />
                        </div>

                        <!-- Areas Covered -->
                        <div class="mb-4">
                            <x-input-label for="areas_covered" :value="__('Areas Covered')" />
                            <textarea id="areas_covered" name="areas_covered" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('areas_covered') }}</textarea>
                            <x-input-error :messages="$errors->get('areas_covered')" class="mt-2" />
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
                            <!-- Material Cost -->
                            <div class="mb-4">
                                <x-input-label for="material_cost" :value="__('Material Cost (R)')" />
                                <x-text-input id="material_cost" class="block mt-1 w-full" type="number" name="material_cost" :value="old('material_cost', 0)" min="0" step="0.01" />
                                <x-input-error :messages="$errors->get('material_cost')" class="mt-2" />
                            </div>

                            <!-- Labor Cost -->
                            <div class="mb-4">
                                <x-input-label for="labor_cost" :value="__('Labor Cost (R)')" />
                                <x-text-input id="labor_cost" class="block mt-1 w-full" type="number" name="labor_cost" :value="old('labor_cost', 0)" min="0" step="0.01" />
                                <x-input-error :messages="$errors->get('labor_cost')" class="mt-2" />
                            </div>

                            <!-- Total Cost -->
                            <div class="mb-4">
                                <x-input-label for="total_cost" :value="__('Total Cost (R)')" />
                                <x-text-input id="total_cost" class="block mt-1 w-full" type="number" name="total_cost" :value="old('total_cost', 0)" min="0" step="0.01" required />
                                <x-input-error :messages="$errors->get('total_cost')" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Start Date -->
                            <div class="mb-4">
                                <x-input-label for="start_date" :value="__('Start Date')" />
                                <x-text-input id="start_date" class="block mt-1 w-full" type="date" name="start_date" :value="old('start_date', date('Y-m-d'))" required />
                                <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
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
                                {{ __('Add Painting') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto-calculate total cost when material cost or labor cost changes
        document.addEventListener('DOMContentLoaded', function() {
            const materialCostInput = document.getElementById('material_cost');
            const laborCostInput = document.getElementById('labor_cost');
            const totalCostInput = document.getElementById('total_cost');

            function calculateTotalCost() {
                const materialCost = parseFloat(materialCostInput.value) || 0;
                const laborCost = parseFloat(laborCostInput.value) || 0;
                const totalCost = materialCost + laborCost;
                
                totalCostInput.value = totalCost.toFixed(2);
            }

            materialCostInput.addEventListener('input', calculateTotalCost);
            laborCostInput.addEventListener('input', calculateTotalCost);
        });
    </script>
</x-app-layout>
