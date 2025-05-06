<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add Sale Information') }}: {{ $car->year }} {{ $car->make }} {{ $car->model }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('cars.show', $car) }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    {{ __('Back to Car Details') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('sales.store', $car) }}" method="POST">
                        @csrf

                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Listing Information') }}</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="listing_date" :value="__('Listing Date')" />
                                    <x-text-input id="listing_date" class="block mt-1 w-full" type="date" name="listing_date" :value="old('listing_date', now()->toDateString())" required />
                                    <x-input-error :messages="$errors->get('listing_date')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="asking_price" :value="__('Asking Price (R)')" />
                                    <x-text-input id="asking_price" class="block mt-1 w-full" type="number" name="asking_price" :value="old('asking_price', $car->estimated_market_value)" min="0" step="0.01" required />
                                    <x-input-error :messages="$errors->get('asking_price')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="platform" :value="__('Platform')" />
                                    <select id="platform" name="platform" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50" required>
                                        <option value="">{{ __('Select Platform') }}</option>
                                        <option value="Dealership" {{ old('platform') == 'Dealership' ? 'selected' : '' }}>{{ __('Dealership') }}</option>
                                        <option value="Online Marketplace" {{ old('platform') == 'Online Marketplace' ? 'selected' : '' }}>{{ __('Online Marketplace') }}</option>
                                        <option value="Private Sale" {{ old('platform') == 'Private Sale' ? 'selected' : '' }}>{{ __('Private Sale') }}</option>
                                        <option value="Auction" {{ old('platform') == 'Auction' ? 'selected' : '' }}>{{ __('Auction') }}</option>
                                        <option value="Other" {{ old('platform') == 'Other' ? 'selected' : '' }}>{{ __('Other') }}</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('platform')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Sale Status') }}</h3>
                            <div class="bg-yellow-50 p-4 rounded-md mb-4 {{ $car->current_phase == 'sold' ? 'hidden' : '' }}">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-yellow-800">{{ __('Car Status Update Required') }}</h3>
                                        <div class="mt-2 text-sm text-yellow-700">
                                            <p>{{ __('This car is currently marked as') }} <strong>{{ ucfirst($car->current_phase) }}</strong>. {{ __('If you are adding sale information because the car has been sold, please check the box below to update the car status.') }}</p>
                                        </div>
                                        <div class="mt-4">
                                            <div class="flex items-center">
                                                <input id="mark_as_sold" name="mark_as_sold" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-green-600 focus:ring-green-500" {{ old('mark_as_sold') ? 'checked' : '' }}>
                                                <label for="mark_as_sold" class="ml-2 block text-sm text-gray-900">{{ __('Mark this car as sold') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Sale Information') }}</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="selling_price" :value="__('Actual Selling Price (R)')" />
                                    <x-text-input id="selling_price" class="block mt-1 w-full" type="number" name="selling_price" :value="old('selling_price')" min="0" step="0.01" required />
                                    <x-input-error :messages="$errors->get('selling_price')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="sale_date" :value="__('Sale Date')" />
                                    <x-text-input id="sale_date" class="block mt-1 w-full" type="date" name="sale_date" :value="old('sale_date', now()->toDateString())" required />
                                    <x-input-error :messages="$errors->get('sale_date')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="buyer_name" :value="__('Buyer Name')" />
                                    <x-text-input id="buyer_name" class="block mt-1 w-full" type="text" name="buyer_name" :value="old('buyer_name')" />
                                    <x-input-error :messages="$errors->get('buyer_name')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="buyer_contact" :value="__('Buyer Contact')" />
                                    <x-text-input id="buyer_contact" class="block mt-1 w-full" type="text" name="buyer_contact" :value="old('buyer_contact')" />
                                    <x-input-error :messages="$errors->get('buyer_contact')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="commission" :value="__('Commission (R)')" />
                                    <x-text-input id="commission" class="block mt-1 w-full" type="number" name="commission" :value="old('commission', 0)" min="0" step="0.01" />
                                    <x-input-error :messages="$errors->get('commission')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="fees" :value="__('Fees (R)')" />
                                    <x-text-input id="fees" class="block mt-1 w-full" type="number" name="fees" :value="old('fees', 0)" min="0" step="0.01" />
                                    <x-input-error :messages="$errors->get('fees')" class="mt-2" />
                                </div>

                                <div class="md:col-span-2">
                                    <x-input-label for="notes" :value="__('Notes')" />
                                    <textarea id="notes" name="notes" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">{{ old('notes') }}</textarea>
                                    <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button class="ml-3">
                                {{ __('Add Sale Information') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
