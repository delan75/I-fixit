<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Record Sale') }}: {{ $car->year }} {{ $car->make }} {{ $car->model }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('dealership.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    {{ __('Back to Dealership') }}
                </a>
                <a href="{{ route('cars.show', $car) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    {{ __('View Car Details') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200">
                    <!-- Car Summary -->
                    <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">{{ __('Car Details') }}</h3>
                                <p class="mt-1 text-lg font-semibold">{{ $car->year }} {{ $car->make }} {{ $car->model }}</p>
                                <p class="text-sm text-gray-600">{{ $car->variant ?? 'Standard' }} | {{ $car->color ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">{{ __('Total Investment') }}</h3>
                                <p class="mt-1 text-lg font-semibold">R {{ number_format($car->total_investment, 2) }}</p>
                                <p class="text-sm text-gray-600">{{ __('Purchase') }}: R {{ number_format($car->purchase_price, 2) }}</p>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">{{ __('Estimated Market Value') }}</h3>
                                <p class="mt-1 text-lg font-semibold">R {{ number_format($car->estimated_market_value ?? 0, 2) }}</p>
                                <p class="text-sm text-gray-600">
                                    @php
                                        $projectedProfit = ($car->estimated_market_value ?? 0) - $car->total_investment;
                                        $profitClass = $projectedProfit > 0 ? 'text-green-600' : 'text-red-600';
                                    @endphp
                                    <span class="{{ $profitClass }}">
                                        {{ __('Projected Profit') }}: R {{ number_format($projectedProfit, 2) }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Sale Form -->
                    <form action="{{ route('dealership.store-sale', $car) }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Left Column -->
                            <div class="space-y-6">
                                <!-- Selling Price -->
                                <div>
                                    <x-input-label for="selling_price" :value="__('Selling Price')" />
                                    <x-text-input id="selling_price" class="block mt-1 w-full" type="number" step="0.01" name="selling_price" :value="old('selling_price', $sale->selling_price ?? $car->estimated_market_value ?? 0)" required />
                                    <x-input-error :messages="$errors->get('selling_price')" class="mt-2" />
                                </div>

                                <!-- Sale Date -->
                                <div>
                                    <x-input-label for="sale_date" :value="__('Sale Date')" />
                                    <x-text-input id="sale_date" class="block mt-1 w-full" type="date" name="sale_date" :value="old('sale_date', $sale->sale_date ? $sale->sale_date->format('Y-m-d') : now()->format('Y-m-d'))" required />
                                    <x-input-error :messages="$errors->get('sale_date')" class="mt-2" />
                                </div>

                                <!-- Buyer Name -->
                                <div>
                                    <x-input-label for="buyer_name" :value="__('Buyer Name')" />
                                    <x-text-input id="buyer_name" class="block mt-1 w-full" type="text" name="buyer_name" :value="old('buyer_name', $sale->buyer_name ?? '')" />
                                    <x-input-error :messages="$errors->get('buyer_name')" class="mt-2" />
                                </div>

                                <!-- Buyer Contact -->
                                <div>
                                    <x-input-label for="buyer_contact" :value="__('Buyer Contact')" />
                                    <x-text-input id="buyer_contact" class="block mt-1 w-full" type="text" name="buyer_contact" :value="old('buyer_contact', $sale->buyer_contact ?? '')" />
                                    <x-input-error :messages="$errors->get('buyer_contact')" class="mt-2" />
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="space-y-6">
                                <!-- Commission -->
                                <div>
                                    <x-input-label for="commission" :value="__('Commission')" />
                                    <x-text-input id="commission" class="block mt-1 w-full" type="number" step="0.01" name="commission" :value="old('commission', $sale->commission ?? 0)" />
                                    <x-input-error :messages="$errors->get('commission')" class="mt-2" />
                                </div>

                                <!-- Fees -->
                                <div>
                                    <x-input-label for="fees" :value="__('Fees')" />
                                    <x-text-input id="fees" class="block mt-1 w-full" type="number" step="0.01" name="fees" :value="old('fees', $sale->fees ?? 0)" />
                                    <x-input-error :messages="$errors->get('fees')" class="mt-2" />
                                </div>

                                <!-- Notes -->
                                <div>
                                    <x-input-label for="notes" :value="__('Notes')" />
                                    <textarea id="notes" name="notes" rows="4" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">{{ old('notes', $sale->notes ?? '') }}</textarea>
                                    <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                                </div>

                                <!-- Mark as Sold Checkbox -->
                                <div class="flex items-center mt-4">
                                    <input id="mark_as_sold" name="mark_as_sold" type="checkbox" class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50" checked>
                                    <label for="mark_as_sold" class="ml-2 block text-sm text-gray-900">
                                        {{ __('Mark car as sold') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Profit Calculation -->
                        <div class="mt-8 p-4 bg-gray-50 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900">{{ __('Profit Calculation') }}</h3>
                            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-600">{{ __('Total Investment') }}</p>
                                    <p class="text-lg font-semibold">R {{ number_format($car->total_investment, 2) }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">{{ __('Selling Price') }}</p>
                                    <p class="text-lg font-semibold" id="display_selling_price">R {{ number_format($sale->selling_price ?? $car->estimated_market_value ?? 0, 2) }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">{{ __('Commission & Fees') }}</p>
                                    <p class="text-lg font-semibold" id="display_commission_fees">R {{ number_format(($sale->commission ?? 0) + ($sale->fees ?? 0), 2) }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">{{ __('Net Profit/Loss') }}</p>
                                    <p class="text-lg font-semibold" id="display_profit_loss">
                                        @php
                                            $netProfit = ($sale->selling_price ?? $car->estimated_market_value ?? 0) - $car->total_investment - ($sale->commission ?? 0) - ($sale->fees ?? 0);
                                            $profitClass = $netProfit > 0 ? 'text-green-600' : 'text-red-600';
                                        @endphp
                                        <span class="{{ $profitClass }}">
                                            R {{ number_format($netProfit, 2) }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end mt-6">
                            <x-primary-button>
                                {{ __('Record Sale') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sellingPriceInput = document.getElementById('selling_price');
            const commissionInput = document.getElementById('commission');
            const feesInput = document.getElementById('fees');
            const displaySellingPrice = document.getElementById('display_selling_price');
            const displayCommissionFees = document.getElementById('display_commission_fees');
            const displayProfitLoss = document.getElementById('display_profit_loss');
            
            const totalInvestment = {{ $car->total_investment }};
            
            function updateCalculations() {
                const sellingPrice = parseFloat(sellingPriceInput.value) || 0;
                const commission = parseFloat(commissionInput.value) || 0;
                const fees = parseFloat(feesInput.value) || 0;
                
                displaySellingPrice.textContent = 'R ' + sellingPrice.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                displayCommissionFees.textContent = 'R ' + (commission + fees).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                
                const netProfit = sellingPrice - totalInvestment - commission - fees;
                displayProfitLoss.innerHTML = '<span class="' + (netProfit > 0 ? 'text-green-600' : 'text-red-600') + '">R ' + 
                    netProfit.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",") + '</span>';
            }
            
            sellingPriceInput.addEventListener('input', updateCalculations);
            commissionInput.addEventListener('input', updateCalculations);
            feesInput.addEventListener('input', updateCalculations);
        });
    </script>
    @endpush
</x-app-layout>
