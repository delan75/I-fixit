<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add Part') }} - {{ $car->make }} {{ $car->model }} ({{ $car->year }})
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
                    <form method="POST" action="{{ route('parts.store', $car) }}">
                        @csrf

                        <!-- Part Name -->
                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Part Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Condition -->
                        <div class="mb-4">
                            <x-input-label for="condition" :value="__('Condition')" />
                            <select id="condition" name="condition" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                                <option value="">{{ __('Select Condition') }}</option>
                                <option value="new" {{ old('condition') == 'new' ? 'selected' : '' }}>{{ __('New') }}</option>
                                <option value="used" {{ old('condition') == 'used' ? 'selected' : '' }}>{{ __('Used') }}</option>
                                <option value="refurbished" {{ old('condition') == 'refurbished' ? 'selected' : '' }}>{{ __('Refurbished') }}</option>
                            </select>
                            <x-input-error :messages="$errors->get('condition')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Quantity -->
                            <div class="mb-4">
                                <x-input-label for="quantity" :value="__('Quantity')" />
                                <x-text-input id="quantity" class="block mt-1 w-full" type="number" name="quantity" :value="old('quantity', 1)" min="1" required />
                                <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                            </div>

                            <!-- Unit Price -->
                            <div class="mb-4">
                                <x-input-label for="unit_price" :value="__('Unit Price (R)')" />
                                <x-text-input id="unit_price" class="block mt-1 w-full" type="number" name="unit_price" :value="old('unit_price', 0)" min="0" step="0.01" required />
                                <x-input-error :messages="$errors->get('unit_price')" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Purchase Date -->
                            <div class="mb-4">
                                <x-input-label for="purchase_date" :value="__('Purchase Date')" />
                                <x-text-input id="purchase_date" class="block mt-1 w-full" type="date" name="purchase_date" :value="old('purchase_date', date('Y-m-d'))" required />
                                <x-input-error :messages="$errors->get('purchase_date')" class="mt-2" />
                            </div>

                            <!-- Installation Date -->
                            <div class="mb-4">
                                <x-input-label for="installation_date" :value="__('Installation Date')" />
                                <x-text-input id="installation_date" class="block mt-1 w-full" type="date" name="installation_date" :value="old('installation_date')" />
                                <x-input-error :messages="$errors->get('installation_date')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Supplier -->
                        <div class="mb-4">
                            <x-input-label for="supplier_id" :value="__('Supplier')" />
                            <select id="supplier_id" name="supplier_id" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="">{{ __('Select Supplier (Optional)') }}</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('supplier_id')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-3">
                                {{ __('Add Part') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
