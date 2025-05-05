<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ isset($car) ? __('Edit Car') : __('Add New Car') }} - {{ __('Step') }} {{ $step }} {{ __('of') }} 4
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('cars.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    {{ __('Back to Cars') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Progress Bar -->
            <div class="mb-6">
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                    <div class="bg-green-600 h-2.5 rounded-full" style="width: {{ ($step / 4) * 100 }}%"></div>
                </div>
                <div class="flex justify-between mt-2 text-xs text-gray-600">
                    <div class="{{ $step >= 1 ? 'text-green-600 font-medium' : '' }}">{{ __('Basic Information') }}</div>
                    <div class="{{ $step >= 2 ? 'text-green-600 font-medium' : '' }}">{{ __('Purchase Information') }}</div>
                    <div class="{{ $step >= 3 ? 'text-green-600 font-medium' : '' }}">{{ __('Damage Information') }}</div>
                    <div class="{{ $step >= 4 ? 'text-green-600 font-medium' : '' }}">{{ __('Status & Projections') }}</div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="step" value="{{ $step }}">
                        @if(isset($car))
                            <input type="hidden" name="car_id" value="{{ $car->id }}">
                        @endif

                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Basic Information') }}</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <x-input-label for="make" :value="__('Make')" />
                                    <x-text-input id="make" class="block mt-1 w-full" type="text" name="make" :value="old('make')" required autofocus />
                                    <x-input-error :messages="$errors->get('make')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="model" :value="__('Model')" />
                                    <x-text-input id="model" class="block mt-1 w-full" type="text" name="model" :value="old('model')" required />
                                    <x-input-error :messages="$errors->get('model')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="year" :value="__('Year')" />
                                    <x-text-input id="year" class="block mt-1 w-full" type="number" name="year" :value="old('year')" min="1900" max="{{ date('Y') + 1 }}" required />
                                    <x-input-error :messages="$errors->get('year')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="vin" :value="__('VIN (Optional)')" />
                                    <x-text-input id="vin" class="block mt-1 w-full" type="text" name="vin" :value="old('vin')" />
                                    <x-input-error :messages="$errors->get('vin')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="registration_number" :value="__('Registration Number (Optional)')" />
                                    <x-text-input id="registration_number" class="block mt-1 w-full" type="text" name="registration_number" :value="old('registration_number')" />
                                    <x-input-error :messages="$errors->get('registration_number')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="color" :value="__('Color (Optional)')" />
                                    <x-text-input id="color" class="block mt-1 w-full" type="text" name="color" :value="old('color')" />
                                    <x-input-error :messages="$errors->get('color')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="body_type" :value="__('Body Type')" />
                                    <select id="body_type" name="body_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50" required>
                                        <option value="">{{ __('Select Body Type') }}</option>
                                        <option value="Sedan" {{ old('body_type') == 'Sedan' ? 'selected' : '' }}>{{ __('Sedan') }}</option>
                                        <option value="Hatchback" {{ old('body_type') == 'Hatchback' ? 'selected' : '' }}>{{ __('Hatchback') }}</option>
                                        <option value="SUV" {{ old('body_type') == 'SUV' ? 'selected' : '' }}>{{ __('SUV') }}</option>
                                        <option value="Bakkie" {{ old('body_type') == 'Bakkie' ? 'selected' : '' }}>{{ __('Bakkie') }}</option>
                                        <option value="Crossover" {{ old('body_type') == 'Crossover' ? 'selected' : '' }}>{{ __('Crossover') }}</option>
                                        <option value="Coupe" {{ old('body_type') == 'Coupe' ? 'selected' : '' }}>{{ __('Coupe') }}</option>
                                        <option value="Convertible" {{ old('body_type') == 'Convertible' ? 'selected' : '' }}>{{ __('Convertible') }}</option>
                                        <option value="Wagon" {{ old('body_type') == 'Wagon' ? 'selected' : '' }}>{{ __('Wagon') }}</option>
                                        <option value="Van" {{ old('body_type') == 'Van' ? 'selected' : '' }}>{{ __('Van') }}</option>
                                        <option value="Truck" {{ old('body_type') == 'Truck' ? 'selected' : '' }}>{{ __('Truck') }}</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('body_type')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="engine_size" :value="__('Engine Size (Optional)')" />
                                    <x-text-input id="engine_size" class="block mt-1 w-full" type="text" name="engine_size" :value="old('engine_size')" placeholder="e.g. 2.0L" />
                                    <x-input-error :messages="$errors->get('engine_size')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="fuel_type" :value="__('Fuel Type')" />
                                    <select id="fuel_type" name="fuel_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50" required>
                                        <option value="">{{ __('Select Fuel Type') }}</option>
                                        <option value="Petrol" {{ old('fuel_type') == 'Petrol' ? 'selected' : '' }}>{{ __('Petrol') }}</option>
                                        <option value="Diesel" {{ old('fuel_type') == 'Diesel' ? 'selected' : '' }}>{{ __('Diesel') }}</option>
                                        <option value="Hybrid" {{ old('fuel_type') == 'Hybrid' ? 'selected' : '' }}>{{ __('Hybrid') }}</option>
                                        <option value="Electric" {{ old('fuel_type') == 'Electric' ? 'selected' : '' }}>{{ __('Electric') }}</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('fuel_type')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="transmission" :value="__('Transmission')" />
                                    <select id="transmission" name="transmission" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50" required>
                                        <option value="">{{ __('Select Transmission') }}</option>
                                        <option value="Manual" {{ old('transmission') == 'Manual' ? 'selected' : '' }}>{{ __('Manual') }}</option>
                                        <option value="Automatic" {{ old('transmission') == 'Automatic' ? 'selected' : '' }}>{{ __('Automatic') }}</option>
                                        <option value="CVT" {{ old('transmission') == 'CVT' ? 'selected' : '' }}>{{ __('CVT') }}</option>
                                        <option value="Semi-Automatic" {{ old('transmission') == 'Semi-Automatic' ? 'selected' : '' }}>{{ __('Semi-Automatic') }}</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('transmission')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="mileage" :value="__('Mileage (km)')" />
                                    <x-text-input id="mileage" class="block mt-1 w-full" type="number" name="mileage" :value="old('mileage')" min="0" required />
                                    <x-input-error :messages="$errors->get('mileage')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Purchase Information') }}</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <x-input-label for="purchase_date" :value="__('Purchase Date')" />
                                    <x-text-input id="purchase_date" class="block mt-1 w-full" type="date" name="purchase_date" :value="old('purchase_date')" required />
                                    <x-input-error :messages="$errors->get('purchase_date')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="purchase_price" :value="__('Purchase Price (R)')" />
                                    <x-text-input id="purchase_price" class="block mt-1 w-full" type="number" name="purchase_price" :value="old('purchase_price')" min="0" step="0.01" required />
                                    <x-input-error :messages="$errors->get('purchase_price')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="auction_house" :value="__('Auction House (Optional)')" />
                                    <x-text-input id="auction_house" class="block mt-1 w-full" type="text" name="auction_house" :value="old('auction_house')" />
                                    <x-input-error :messages="$errors->get('auction_house')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="auction_lot_number" :value="__('Auction Lot Number (Optional)')" />
                                    <x-text-input id="auction_lot_number" class="block mt-1 w-full" type="text" name="auction_lot_number" :value="old('auction_lot_number')" />
                                    <x-input-error :messages="$errors->get('auction_lot_number')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="transportation_cost" :value="__('Transportation Cost (R)')" />
                                    <x-text-input id="transportation_cost" class="block mt-1 w-full" type="number" name="transportation_cost" :value="old('transportation_cost', 0)" min="0" step="0.01" />
                                    <x-input-error :messages="$errors->get('transportation_cost')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="registration_papers_cost" :value="__('Registration Papers Cost (R)')" />
                                    <x-text-input id="registration_papers_cost" class="block mt-1 w-full" type="number" name="registration_papers_cost" :value="old('registration_papers_cost', 0)" min="0" step="0.01" />
                                    <x-input-error :messages="$errors->get('registration_papers_cost')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="number_plates_cost" :value="__('Number Plates Cost (R)')" />
                                    <x-text-input id="number_plates_cost" class="block mt-1 w-full" type="number" name="number_plates_cost" :value="old('number_plates_cost', 0)" min="0" step="0.01" />
                                    <x-input-error :messages="$errors->get('number_plates_cost')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="other_costs" :value="__('Other Costs (R)')" />
                                    <x-text-input id="other_costs" class="block mt-1 w-full" type="number" name="other_costs" :value="old('other_costs', 0)" min="0" step="0.01" />
                                    <x-input-error :messages="$errors->get('other_costs')" class="mt-2" />
                                </div>

                                <div class="md:col-span-2">
                                    <x-input-label for="other_costs_description" :value="__('Other Costs Description (Optional)')" />
                                    <x-text-input id="other_costs_description" class="block mt-1 w-full" type="text" name="other_costs_description" :value="old('other_costs_description')" />
                                    <x-input-error :messages="$errors->get('other_costs_description')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Damage Information') }}</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="damage_severity" :value="__('Damage Severity')" />
                                    <select id="damage_severity" name="damage_severity" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50" required>
                                        <option value="">{{ __('Select Damage Severity') }}</option>
                                        <option value="light" {{ old('damage_severity') == 'light' ? 'selected' : '' }}>{{ __('Light') }}</option>
                                        <option value="moderate" {{ old('damage_severity') == 'moderate' ? 'selected' : '' }}>{{ __('Moderate') }}</option>
                                        <option value="severe" {{ old('damage_severity') == 'severe' ? 'selected' : '' }}>{{ __('Severe') }}</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('damage_severity')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="operational_status" :value="__('Operational Status')" />
                                    <select id="operational_status" name="operational_status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50" required>
                                        <option value="">{{ __('Select Operational Status') }}</option>
                                        <option value="running" {{ old('operational_status') == 'running' ? 'selected' : '' }}>{{ __('Running') }}</option>
                                        <option value="non-running" {{ old('operational_status') == 'non-running' ? 'selected' : '' }}>{{ __('Non-Running') }}</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('operational_status')" class="mt-2" />
                                </div>

                                <div class="md:col-span-2">
                                    <x-input-label for="damage_description" :value="__('Damage Description')" />
                                    <textarea id="damage_description" name="damage_description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50" required>{{ old('damage_description') }}</textarea>
                                    <x-input-error :messages="$errors->get('damage_description')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Status & Projections') }}</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <x-input-label for="current_phase" :value="__('Current Phase')" />
                                    <select id="current_phase" name="current_phase" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50" required>
                                        <option value="">{{ __('Select Current Phase') }}</option>
                                        <option value="bidding" {{ old('current_phase') == 'bidding' ? 'selected' : '' }}>{{ __('Bidding') }}</option>
                                        <option value="fixing" {{ old('current_phase') == 'fixing' ? 'selected' : '' }}>{{ __('Fixing') }}</option>
                                        <option value="dealership" {{ old('current_phase') == 'dealership' ? 'selected' : '' }}>{{ __('At Dealership') }}</option>
                                        <option value="sold" {{ old('current_phase') == 'sold' ? 'selected' : '' }}>{{ __('Sold') }}</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('current_phase')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="estimated_repair_cost" :value="__('Estimated Repair Cost (R)')" />
                                    <x-text-input id="estimated_repair_cost" class="block mt-1 w-full" type="number" name="estimated_repair_cost" :value="old('estimated_repair_cost', 0)" min="0" step="0.01" />
                                    <x-input-error :messages="$errors->get('estimated_repair_cost')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="estimated_market_value" :value="__('Estimated Market Value (R)')" />
                                    <x-text-input id="estimated_market_value" class="block mt-1 w-full" type="number" name="estimated_market_value" :value="old('estimated_market_value')" min="0" step="0.01" />
                                    <x-input-error :messages="$errors->get('estimated_market_value')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="repair_start_date" :value="__('Repair Start Date (Optional)')" />
                                    <x-text-input id="repair_start_date" class="block mt-1 w-full" type="date" name="repair_start_date" :value="old('repair_start_date')" />
                                    <x-input-error :messages="$errors->get('repair_start_date')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="repair_end_date" :value="__('Repair End Date (Optional)')" />
                                    <x-text-input id="repair_end_date" class="block mt-1 w-full" type="date" name="repair_end_date" :value="old('repair_end_date')" />
                                    <x-input-error :messages="$errors->get('repair_end_date')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="dealership_date" :value="__('Dealership Date (Optional)')" />
                                    <x-text-input id="dealership_date" class="block mt-1 w-full" type="date" name="dealership_date" :value="old('dealership_date')" />
                                    <x-input-error :messages="$errors->get('dealership_date')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="dealership_discount" :value="__('Dealership Discount (R)')" />
                                    <x-text-input id="dealership_discount" class="block mt-1 w-full" type="number" name="dealership_discount" :value="old('dealership_discount', 0)" min="0" step="0.01" />
                                    <x-input-error :messages="$errors->get('dealership_discount')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="sold_date" :value="__('Sold Date (Optional)')" />
                                    <x-text-input id="sold_date" class="block mt-1 w-full" type="date" name="sold_date" :value="old('sold_date')" />
                                    <x-input-error :messages="$errors->get('sold_date')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Additional Information') }}</h3>
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <x-input-label for="notes" :value="__('Notes (Optional)')" />
                                    <textarea id="notes" name="notes" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">{{ old('notes') }}</textarea>
                                    <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Images') }}</h3>
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <x-input-label for="images" :value="__('Upload Images (Optional)')" />
                                    <input id="images" type="file" name="images[]" multiple class="mt-1 block w-full text-sm text-gray-500
                                        file:mr-4 file:py-2 file:px-4
                                        file:rounded-md file:border-0
                                        file:text-sm file:font-semibold
                                        file:bg-green-50 file:text-green-700
                                        hover:file:bg-green-100" />
                                    <p class="mt-1 text-sm text-gray-500">{{ __('You can upload multiple images. Accepted formats: JPG, PNG, GIF.') }}</p>
                                    <x-input-error :messages="$errors->get('images')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="image_type" :value="__('Image Type')" />
                                    <select id="image_type" name="image_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                        <option value="before_repair" {{ old('image_type') == 'before_repair' ? 'selected' : '' }}>{{ __('Before Repair') }}</option>
                                        <option value="during_repair" {{ old('image_type') == 'during_repair' ? 'selected' : '' }}>{{ __('During Repair') }}</option>
                                        <option value="after_repair" {{ old('image_type') == 'after_repair' ? 'selected' : '' }}>{{ __('After Repair') }}</option>
                                        <option value="damage" {{ old('image_type') == 'damage' ? 'selected' : '' }}>{{ __('Damage') }}</option>
                                        <option value="other" {{ old('image_type') == 'other' ? 'selected' : '' }}>{{ __('Other') }}</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('image_type')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="image_description" :value="__('Image Description (Optional)')" />
                                    <x-text-input id="image_description" class="block mt-1 w-full" type="text" name="image_description" :value="old('image_description')" />
                                    <x-input-error :messages="$errors->get('image_description')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button class="ml-3">
                                {{ __('Add Car') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
