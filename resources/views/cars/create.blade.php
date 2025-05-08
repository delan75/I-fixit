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

                        <!-- Step-specific content -->
                        @if($step == 1)
                            <!-- Basic Information -->
                            <div class="mb-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Basic Information') }}</h3>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <!-- Make -->
                                    <div>
                                        <label for="make" class="block text-sm font-medium text-gray-700">{{ __('Make') }}</label>
                                        <input type="text" name="make" id="make" value="{{ old('make', $car->make ?? '') }}" required
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                            placeholder="Start typing to see suggestions..." autocomplete="off">
                                    </div>

                                    <!-- Model -->
                                    <div>
                                        <label for="model" class="block text-sm font-medium text-gray-700">{{ __('Model') }}</label>
                                        <input type="text" name="model" id="model" value="{{ old('model', $car->model ?? '') }}" required
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                            placeholder="Select make first..." autocomplete="off">
                                    </div>

                                    <!-- Variant/Trim -->
                                    <div>
                                        <label for="variant" class="block text-sm font-medium text-gray-700">{{ __('Variant/Trim') }}</label>
                                        <input type="text" name="variant" id="variant" value="{{ old('variant', $car->variant ?? '') }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                            placeholder="Select model first..." autocomplete="off">
                                    </div>

                                    <!-- Year -->
                                    <div>
                                        <label for="year" class="block text-sm font-medium text-gray-700">{{ __('Year') }}</label>
                                        <input type="number" name="year" id="year" value="{{ old('year', $car->year ?? '') }}" required
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>

                                    <!-- VIN -->
                                    <div>
                                        <label for="vin" class="block text-sm font-medium text-gray-700">{{ __('VIN') }}</label>
                                        <input type="text" name="vin" id="vin" value="{{ old('vin', $car->vin ?? '') }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>

                                    <!-- Registration Number -->
                                    <div>
                                        <label for="registration_number" class="block text-sm font-medium text-gray-700">{{ __('Registration Number') }}</label>
                                        <input type="text" name="registration_number" id="registration_number" value="{{ old('registration_number', $car->registration_number ?? '') }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>

                                    <!-- Color -->
                                    <div>
                                        <label for="color" class="block text-sm font-medium text-gray-700">{{ __('Color') }}</label>
                                        <input type="text" name="color" id="color" value="{{ old('color', $car->color ?? '') }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                            placeholder="Start typing to see colors..." autocomplete="off">
                                    </div>

                                    <!-- Interior Type -->
                                    <div>
                                        <label for="interior_type" class="block text-sm font-medium text-gray-700">{{ __('Interior Type') }}</label>
                                        <select name="interior_type" id="interior_type"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            <option value="">{{ __('Select Interior Type') }}</option>
                                            <option value="Cloth" {{ old('interior_type', $car->interior_type ?? '') == 'Cloth' ? 'selected' : '' }}>{{ __('Cloth') }}</option>
                                            <option value="Leather" {{ old('interior_type', $car->interior_type ?? '') == 'Leather' ? 'selected' : '' }}>{{ __('Leather') }}</option>
                                            <option value="Leatherette" {{ old('interior_type', $car->interior_type ?? '') == 'Leatherette' ? 'selected' : '' }}>{{ __('Leatherette') }}</option>
                                            <option value="Alcantara" {{ old('interior_type', $car->interior_type ?? '') == 'Alcantara' ? 'selected' : '' }}>{{ __('Alcantara') }}</option>
                                            <option value="Mixed" {{ old('interior_type', $car->interior_type ?? '') == 'Mixed' ? 'selected' : '' }}>{{ __('Mixed') }}</option>
                                        </select>
                                    </div>

                                    <!-- Body Type -->
                                    <div>
                                        <label for="body_type" class="block text-sm font-medium text-gray-700">{{ __('Body Type') }}</label>
                                        <input type="text" name="body_type" id="body_type" value="{{ old('body_type', $car->body_type ?? '') }}" required
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                            placeholder="Start typing to see body types..." autocomplete="off">
                                    </div>

                                    <!-- Engine Size -->
                                    <div>
                                        <label for="engine_size" class="block text-sm font-medium text-gray-700">{{ __('Engine Size') }}</label>
                                        <input type="text" name="engine_size" id="engine_size" value="{{ old('engine_size', $car->engine_size ?? '') }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>

                                    <!-- Fuel Type -->
                                    <div>
                                        <label for="fuel_type" class="block text-sm font-medium text-gray-700">{{ __('Fuel Type') }}</label>
                                        <select name="fuel_type" id="fuel_type" required
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            <option value="">{{ __('Select Fuel Type') }}</option>
                                            <option value="Petrol" {{ old('fuel_type', $car->fuel_type ?? '') == 'Petrol' ? 'selected' : '' }}>{{ __('Petrol') }}</option>
                                            <option value="Diesel" {{ old('fuel_type', $car->fuel_type ?? '') == 'Diesel' ? 'selected' : '' }}>{{ __('Diesel') }}</option>
                                            <option value="Electric" {{ old('fuel_type', $car->fuel_type ?? '') == 'Electric' ? 'selected' : '' }}>{{ __('Electric') }}</option>
                                            <option value="Hybrid" {{ old('fuel_type', $car->fuel_type ?? '') == 'Hybrid' ? 'selected' : '' }}>{{ __('Hybrid') }}</option>
                                        </select>
                                    </div>

                                    <!-- Transmission -->
                                    <div>
                                        <label for="transmission" class="block text-sm font-medium text-gray-700">{{ __('Transmission') }}</label>
                                        <select name="transmission" id="transmission" required
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            <option value="">{{ __('Select Transmission') }}</option>
                                            <option value="Manual" {{ old('transmission', $car->transmission ?? '') == 'Manual' ? 'selected' : '' }}>{{ __('Manual') }}</option>
                                            <option value="Automatic" {{ old('transmission', $car->transmission ?? '') == 'Automatic' ? 'selected' : '' }}>{{ __('Automatic') }}</option>
                                        </select>
                                    </div>

                                    <!-- Mileage -->
                                    <div>
                                        <label for="mileage" class="block text-sm font-medium text-gray-700">{{ __('Mileage (km)') }}</label>
                                        <input type="number" name="mileage" id="mileage" value="{{ old('mileage', $car->mileage ?? '') }}" required
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>
                                </div>
                            </div>
                        @elseif($step == 2)
                            <!-- Purchase Information -->
                            <div class="mb-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Purchase Information') }}</h3>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <!-- Purchase Date -->
                                    <div>
                                        <label for="purchase_date" class="block text-sm font-medium text-gray-700">{{ __('Purchase Date') }}</label>
                                        <input type="date" name="purchase_date" id="purchase_date" value="{{ old('purchase_date', $car->purchase_date ?? '') }}" required
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>

                                    <!-- Purchase Price -->
                                    <div>
                                        <label for="purchase_price" class="block text-sm font-medium text-gray-700">{{ __('Purchase Price') }}</label>
                                        <input type="number" name="purchase_price" id="purchase_price" value="{{ old('purchase_price', $car->purchase_price ?? '') }}" required
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>

                                    <!-- Auction House -->
                                    <div>
                                        <label for="auction_house" class="block text-sm font-medium text-gray-700">{{ __('Auction House') }}</label>
                                        <input type="text" name="auction_house" id="auction_house" value="{{ old('auction_house', $car->auction_house ?? '') }}" list="auction_house_list" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" autocomplete="off">
                                        <datalist id="auction_house_list">
                                            <option value="Auction Nation">
                                            <option value="GoBid">
                                            <option value="SMD">
                                            <option value="WesBank Auction">
                                            <option value="Other">
                                        </datalist>
                                    </div>

                                    <!-- Auction Branch -->
                                    <div>
                                        <label for="auction_branch" class="block text-sm font-medium text-gray-700">{{ __('Auction Branch (Optional)') }}</label>
                                        <input type="text" name="auction_branch" id="auction_branch" value="{{ old('auction_branch', $car->auction_branch ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="e.g. Johannesburg, Cape Town, Durban">
                                    </div>

                                    <!-- Auction Lot Number -->
                                    <div>
                                        <label for="auction_lot_number" class="block text-sm font-medium text-gray-700">{{ __('Auction Lot Number') }}</label>
                                        <input type="text" name="auction_lot_number" id="auction_lot_number" value="{{ old('auction_lot_number', $car->auction_lot_number ?? '') }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>

                                    <!-- Transportation Cost -->
                                    <div>
                                        <label for="transportation_cost" class="block text-sm font-medium text-gray-700">{{ __('Transportation Cost') }}</label>
                                        <input type="number" name="transportation_cost" id="transportation_cost" value="{{ old('transportation_cost', $car->transportation_cost ?? '') }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>

                                    <!-- Registration Papers Cost -->
                                    <div>
                                        <label for="registration_papers_cost" class="block text-sm font-medium text-gray-700">{{ __('Registration Papers Cost') }}</label>
                                        <input type="number" name="registration_papers_cost" id="registration_papers_cost" value="{{ old('registration_papers_cost', $car->registration_papers_cost ?? '') }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>

                                    <!-- Number Plates Cost -->
                                    <div>
                                        <label for="number_plates_cost" class="block text-sm font-medium text-gray-700">{{ __('Number Plates Cost') }}</label>
                                        <input type="number" name="number_plates_cost" id="number_plates_cost" value="{{ old('number_plates_cost', $car->number_plates_cost ?? '') }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>

                                    <!-- Other Costs -->
                                    <div>
                                        <label for="other_costs" class="block text-sm font-medium text-gray-700">{{ __('Other Costs') }}</label>
                                        <input type="number" name="other_costs" id="other_costs" value="{{ old('other_costs', $car->other_costs ?? '') }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>

                                    <!-- Other Costs Description -->
                                    <div>
                                        <label for="other_costs_description" class="block text-sm font-medium text-gray-700">{{ __('Other Costs Description') }}</label>
                                        <textarea name="other_costs_description" id="other_costs_description"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('other_costs_description', $car->other_costs_description ?? '') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        @elseif($step == 3)
                            <!-- Damage Information -->
                            <div class="mb-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Damage Information') }}</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Damage Description -->
                                    <div>
                                        <label for="damage_description" class="block text-sm font-medium text-gray-700">{{ __('Damage Description (Optional)') }}</label>
                                        <textarea name="damage_description" id="damage_description"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('damage_description', $car->damage_description ?? '') }}</textarea>
                                    </div>

                                    <!-- Damage Severity -->
                                    <div>
                                        <label for="damage_severity" class="block text-sm font-medium text-gray-700">{{ __('Damage Severity') }}</label>
                                        <select name="damage_severity" id="damage_severity" required
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            <option value="">{{ __('Select Severity') }}</option>
                                            <option value="light" {{ old('damage_severity', $car->damage_severity ?? '') == 'light' ? 'selected' : '' }}>{{ __('Light') }}</option>
                                            <option value="moderate" {{ old('damage_severity', $car->damage_severity ?? '') == 'moderate' ? 'selected' : '' }}>{{ __('Moderate') }}</option>
                                            <option value="severe" {{ old('damage_severity', $car->damage_severity ?? '') == 'severe' ? 'selected' : '' }}>{{ __('Severe') }}</option>
                                        </select>
                                    </div>

                                    <!-- Operational Status -->
                                    <div>
                                        <label for="operational_status" class="block text-sm font-medium text-gray-700">{{ __('Operational Status') }}</label>
                                        <select name="operational_status" id="operational_status" required
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            <option value="">{{ __('Select Status') }}</option>
                                            <option value="running" {{ old('operational_status', $car->operational_status ?? '') == 'running' ? 'selected' : '' }}>{{ __('Running') }}</option>
                                            <option value="non-running" {{ old('operational_status', $car->operational_status ?? '') == 'non-running' ? 'selected' : '' }}>{{ __('Non-Running') }}</option>
                                        </select>
                                    </div>

                                    <!-- Vehicle Code -->
                                    <div>
                                        <label for="vehicle_code" class="block text-sm font-medium text-gray-700">{{ __('Vehicle Code') }}</label>
                                        <select name="vehicle_code" id="vehicle_code" required
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            <option value="">{{ __('Select Code') }}</option>
                                            <option value="Code 2" {{ old('vehicle_code', $car->vehicle_code ?? '') == 'Code 2' ? 'selected' : '' }}>{{ __('Code 2') }}</option>
                                            <option value="Code 3" {{ old('vehicle_code', $car->vehicle_code ?? '') == 'Code 3' ? 'selected' : '' }}>{{ __('Code 3') }}</option>
                                            <option value="Code 4" {{ old('vehicle_code', $car->vehicle_code ?? '') == 'Code 4' ? 'selected' : '' }}>{{ __('Code 4') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @elseif($step == 4)
                            <!-- Status & Projections -->
                            <div class="mb-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Status & Projections') }}</h3>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <!-- Current Phase -->
                                    <div>
                                        <label for="current_phase" class="block text-sm font-medium text-gray-700">{{ __('Current Phase') }}</label>
                                        <select name="current_phase" id="current_phase" required
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            <option value="">{{ __('Select Phase') }}</option>
                                            <option value="bidding" {{ old('current_phase', $car->current_phase ?? '') == 'bidding' ? 'selected' : '' }}>{{ __('Bidding') }}</option>
                                            <option value="fixing" {{ old('current_phase', $car->current_phase ?? '') == 'fixing' ? 'selected' : '' }}>{{ __('Fixing') }}</option>
                                            <option value="dealership" {{ old('current_phase', $car->current_phase ?? '') == 'dealership' ? 'selected' : '' }}>{{ __('Dealership') }}</option>
                                            <option value="sold" {{ old('current_phase', $car->current_phase ?? '') == 'sold' ? 'selected' : '' }}>{{ __('Sold') }}</option>
                                        </select>
                                    </div>

                                    <!-- Repair Start Date -->
                                    <div>
                                        <label for="repair_start_date" class="block text-sm font-medium text-gray-700">{{ __('Repair Start Date') }}</label>
                                        <input type="date" name="repair_start_date" id="repair_start_date" value="{{ old('repair_start_date', $car->repair_start_date ?? '') }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>

                                    <!-- Repair End Date -->
                                    <div>
                                        <label for="repair_end_date" class="block text-sm font-medium text-gray-700">{{ __('Repair End Date') }}</label>
                                        <input type="date" name="repair_end_date" id="repair_end_date" value="{{ old('repair_end_date', $car->repair_end_date ?? '') }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>

                                    <!-- Dealership Date -->
                                    <div>
                                        <label for="dealership_date" class="block text-sm font-medium text-gray-700">{{ __('Dealership Date') }}</label>
                                        <input type="date" name="dealership_date" id="dealership_date" value="{{ old('dealership_date', $car->dealership_date ?? '') }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>

                                    <!-- Sold Date -->
                                    <div>
                                        <label for="sold_date" class="block text-sm font-medium text-gray-700">{{ __('Sold Date') }}</label>
                                        <input type="date" name="sold_date" id="sold_date" value="{{ old('sold_date', $car->sold_date ?? '') }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>

                                    <!-- Repair Cost (Estimated or Actual based on phase) -->
                                    <div>
                                        <label for="estimated_repair_cost" class="block text-sm font-medium text-gray-700" id="repair_cost_label">
                                            {{ __('Estimated Repair Cost') }}
                                        </label>
                                        <input type="number" name="estimated_repair_cost" id="estimated_repair_cost" value="{{ old('estimated_repair_cost', $car->estimated_repair_cost ?? '') }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>

                                    <!-- Market Value (Estimated or Actual based on phase) -->
                                    <div>
                                        <label for="estimated_market_value" class="block text-sm font-medium text-gray-700" id="market_value_label">
                                            {{ __('Estimated Market Value') }}
                                        </label>
                                        <input type="number" name="estimated_market_value" id="estimated_market_value" value="{{ old('estimated_market_value', $car->estimated_market_value ?? '') }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>

                                    <!-- Dealership Discount -->
                                    <div>
                                        <label for="dealership_discount" class="block text-sm font-medium text-gray-700">{{ __('Dealership Discount') }}</label>
                                        <input type="number" name="dealership_discount" id="dealership_discount" value="{{ old('dealership_discount', $car->dealership_discount ?? '') }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>

                                    <!-- Notes -->
                                    <div class="col-span-3">
                                        <label for="notes" class="block text-sm font-medium text-gray-700">{{ __('Notes') }}</label>
                                        <textarea name="notes" id="notes"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('notes', $car->notes ?? '') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Navigation Buttons -->
                        <div class="flex items-center justify-between mt-6">
                            <div>
                                @if($step > 1)
                                    <button type="submit" name="action" value="back" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        {{ __('Back') }}
                                    </button>
                                @endif
                            </div>
                            <div class="flex space-x-2">
                                <button type="submit" name="action" value="save" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    {{ __('Save') }}
                                </button>
                                <button type="submit" name="action" value="next" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    {{ $step < 4 ? __('Next') : __('Complete') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if($step == 1)
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize all car autocomplete fields
            CarAutocomplete.initializeAll({
                makeInputId: 'make',
                modelInputId: 'model',
                variantInputId: 'variant',
                bodyTypeInputId: 'body_type',
                colorInputId: 'color'
            });
        });
    </script>
    @endif

    @if($step == 4)
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get elements
            const currentPhaseSelect = document.getElementById('current_phase');
            const repairCostLabel = document.getElementById('repair_cost_label');
            const marketValueLabel = document.getElementById('market_value_label');

            // Function to update labels based on selected phase
            function updateLabels() {
                const selectedPhase = currentPhaseSelect.value;

                // Update repair cost label
                if (selectedPhase === 'dealership' || selectedPhase === 'sold') {
                    repairCostLabel.textContent = "{{ __('Total Repair Cost') }}";
                } else {
                    repairCostLabel.textContent = "{{ __('Estimated Repair Cost') }}";
                }

                // Update market value label
                if (selectedPhase === 'sold') {
                    marketValueLabel.textContent = "{{ __('Actual Selling Price') }}";
                } else {
                    marketValueLabel.textContent = "{{ __('Estimated Market Value') }}";
                }
            }

            // Set initial labels
            updateLabels();

            // Add event listener for phase changes
            currentPhaseSelect.addEventListener('change', updateLabels);
        });
    </script>
    @endif
</x-app-layout>
