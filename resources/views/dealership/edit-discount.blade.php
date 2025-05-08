<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Update Dealership Discount') }}: {{ $car->year }} {{ $car->make }} {{ $car->model }}
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

                    <!-- Discount Form -->
                    <form action="{{ route('dealership.update-discount', $car) }}" method="POST">
                        @csrf

                        <div class="space-y-6">
                            <!-- Current Discount -->
                            <div class="p-4 bg-yellow-50 rounded-lg">
                                <h3 class="text-lg font-medium text-yellow-800">{{ __('Current Discount') }}</h3>
                                <p class="mt-2 text-yellow-700">
                                    @if($car->dealership_discount)
                                        {{ __('This car currently has a discount of') }} <span class="font-semibold">R {{ number_format($car->dealership_discount, 2) }}</span>
                                    @else
                                        {{ __('This car currently has no discount applied.') }}
                                    @endif
                                </p>
                            </div>

                            <!-- Dealership Discount -->
                            <div>
                                <x-input-label for="dealership_discount" :value="__('Dealership Discount')" />
                                <x-text-input id="dealership_discount" class="block mt-1 w-full" type="number" step="0.01" name="dealership_discount" :value="old('dealership_discount', $car->dealership_discount ?? 0)" required />
                                <x-input-error :messages="$errors->get('dealership_discount')" class="mt-2" />
                                <p class="mt-1 text-sm text-gray-500">{{ __('Enter the amount to discount from the car\'s price.') }}</p>
                            </div>

                            <!-- Discount Reason -->
                            <div>
                                <x-input-label for="discount_reason" :value="__('Reason for Discount')" />
                                <textarea id="discount_reason" name="discount_reason" rows="3" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">{{ old('discount_reason', '') }}</textarea>
                                <x-input-error :messages="$errors->get('discount_reason')" class="mt-2" />
                                <p class="mt-1 text-sm text-gray-500">{{ __('Provide a reason for applying this discount.') }}</p>
                            </div>
                        </div>

                        <!-- Profit Calculation -->
                        <div class="mt-8 p-4 bg-gray-50 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900">{{ __('Impact on Profit') }}</h3>
                            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-600">{{ __('Total Investment') }}</p>
                                    <p class="text-lg font-semibold">R {{ number_format($car->total_investment, 2) }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">{{ __('Estimated Market Value') }}</p>
                                    <p class="text-lg font-semibold">R {{ number_format($car->estimated_market_value ?? 0, 2) }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">{{ __('Current Projected Profit') }}</p>
                                    <p class="text-lg font-semibold {{ $profitClass }}">R {{ number_format($projectedProfit, 2) }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">{{ __('New Projected Profit') }}</p>
                                    <p class="text-lg font-semibold" id="new_projected_profit">
                                        @php
                                            $newProfit = $projectedProfit;
                                            $newProfitClass = $newProfit > 0 ? 'text-green-600' : 'text-red-600';
                                        @endphp
                                        <span class="{{ $newProfitClass }}">
                                            R {{ number_format($newProfit, 2) }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end mt-6">
                            <x-primary-button>
                                {{ __('Update Discount') }}
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
            const discountInput = document.getElementById('dealership_discount');
            const newProjectedProfitElement = document.getElementById('new_projected_profit');
            
            const totalInvestment = {{ $car->total_investment }};
            const estimatedMarketValue = {{ $car->estimated_market_value ?? 0 }};
            const currentDiscount = {{ $car->dealership_discount ?? 0 }};
            
            function updateCalculations() {
                const newDiscount = parseFloat(discountInput.value) || 0;
                const newProfit = estimatedMarketValue - (totalInvestment - newDiscount + currentDiscount);
                
                const profitClass = newProfit > 0 ? 'text-green-600' : 'text-red-600';
                newProjectedProfitElement.innerHTML = '<span class="' + profitClass + '">R ' + 
                    newProfit.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",") + '</span>';
            }
            
            discountInput.addEventListener('input', updateCalculations);
            
            // Initial calculation
            updateCalculations();
        });
    </script>
    @endpush
</x-app-layout>
