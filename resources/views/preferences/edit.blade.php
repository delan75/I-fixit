<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notification Preferences') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('preferences.update') }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Notification Channels') }}</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="flex items-center">
                                    <input id="notification_app" name="notification_app" type="checkbox" class="h-4 w-4 text-indigo-600 border-gray-300 rounded" {{ $preferences->notification_app ? 'checked' : '' }}>
                                    <label for="notification_app" class="ml-2 block text-sm text-gray-900">{{ __('In-App Notifications') }}</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="notification_email" name="notification_email" type="checkbox" class="h-4 w-4 text-indigo-600 border-gray-300 rounded" {{ $preferences->notification_email ? 'checked' : '' }}>
                                    <label for="notification_email" class="ml-2 block text-sm text-gray-900">{{ __('Email Notifications') }}</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="notification_sms" name="notification_sms" type="checkbox" class="h-4 w-4 text-indigo-600 border-gray-300 rounded" {{ $preferences->notification_sms ? 'checked' : '' }}>
                                    <label for="notification_sms" class="ml-2 block text-sm text-gray-900">{{ __('SMS Notifications') }}</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Notification Types') }}</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <div class="flex items-center mb-2">
                                        <input id="notification_repair_phase" name="notification_repair_phase" type="checkbox" class="h-4 w-4 text-indigo-600 border-gray-300 rounded" {{ $preferences->notification_repair_phase ? 'checked' : '' }}>
                                        <label for="notification_repair_phase" class="ml-2 block text-sm text-gray-900">{{ __('Repair Phase Alerts') }}</label>
                                    </div>
                                    <div class="ml-6 mb-4">
                                        <label for="repair_phase_days_threshold" class="block text-sm font-medium text-gray-700">{{ __('Alert when car is in repair phase for more than:') }}</label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <input type="number" name="repair_phase_days_threshold" id="repair_phase_days_threshold" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-l-md sm:text-sm border-gray-300" value="{{ $preferences->repair_phase_days_threshold }}">
                                            <span class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">{{ __('days') }}</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="flex items-center mb-2">
                                        <input id="notification_dealership_phase" name="notification_dealership_phase" type="checkbox" class="h-4 w-4 text-indigo-600 border-gray-300 rounded" {{ $preferences->notification_dealership_phase ? 'checked' : '' }}>
                                        <label for="notification_dealership_phase" class="ml-2 block text-sm text-gray-900">{{ __('Dealership Phase Alerts') }}</label>
                                    </div>
                                    <div class="ml-6 mb-4">
                                        <label for="dealership_phase_days_threshold" class="block text-sm font-medium text-gray-700">{{ __('Alert when car is at dealership for more than:') }}</label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <input type="number" name="dealership_phase_days_threshold" id="dealership_phase_days_threshold" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-l-md sm:text-sm border-gray-300" value="{{ $preferences->dealership_phase_days_threshold }}">
                                            <span class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">{{ __('days') }}</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="flex items-center mb-2">
                                        <input id="notification_budget_exceeded" name="notification_budget_exceeded" type="checkbox" class="h-4 w-4 text-indigo-600 border-gray-300 rounded" {{ $preferences->notification_budget_exceeded ? 'checked' : '' }}>
                                        <label for="notification_budget_exceeded" class="ml-2 block text-sm text-gray-900">{{ __('Budget Exceeded Alerts') }}</label>
                                    </div>
                                    <div class="ml-6 mb-4">
                                        <label for="budget_exceeded_percentage" class="block text-sm font-medium text-gray-700">{{ __('Alert when repair costs exceed budget by:') }}</label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <input type="number" name="budget_exceeded_percentage" id="budget_exceeded_percentage" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-l-md sm:text-sm border-gray-300" value="{{ $preferences->budget_exceeded_percentage }}">
                                            <span class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">{{ __('%') }}</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="flex items-center mb-2">
                                        <input id="notification_opportunity" name="notification_opportunity" type="checkbox" class="h-4 w-4 text-indigo-600 border-gray-300 rounded" {{ $preferences->notification_opportunity ? 'checked' : '' }}>
                                        <label for="notification_opportunity" class="ml-2 block text-sm text-gray-900">{{ __('Investment Opportunity Alerts') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Investment Preferences') }}</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="min_profit" class="block text-sm font-medium text-gray-700">{{ __('Minimum Expected Profit (R)') }}</label>
                                    <input type="number" name="min_profit" id="min_profit" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $preferences->min_profit }}">
                                </div>
                                
                                <div>
                                    <label for="max_investment" class="block text-sm font-medium text-gray-700">{{ __('Maximum Investment Amount (R)') }}</label>
                                    <input type="number" name="max_investment" id="max_investment" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $preferences->max_investment }}">
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="min_year" class="block text-sm font-medium text-gray-700">{{ __('Minimum Vehicle Year') }}</label>
                                    <input type="number" name="min_year" id="min_year" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $preferences->min_year }}">
                                </div>
                                
                                <div>
                                    <label for="max_year" class="block text-sm font-medium text-gray-700">{{ __('Maximum Vehicle Year') }}</label>
                                    <input type="number" name="max_year" id="max_year" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $preferences->max_year }}">
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="preferred_makes" class="block text-sm font-medium text-gray-700">{{ __('Preferred Makes') }}</label>
                                    <select id="preferred_makes" name="preferred_makes[]" multiple class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        @foreach($makes as $make)
                                            <option value="{{ $make }}" {{ is_array($preferences->preferred_makes) && in_array($make, $preferences->preferred_makes) ? 'selected' : '' }}>{{ $make }}</option>
                                        @endforeach
                                    </select>
                                    <p class="mt-1 text-xs text-gray-500">{{ __('Hold Ctrl/Cmd to select multiple') }}</p>
                                </div>
                                
                                <div>
                                    <label for="preferred_models" class="block text-sm font-medium text-gray-700">{{ __('Preferred Models') }}</label>
                                    <select id="preferred_models" name="preferred_models[]" multiple class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        @if(is_array($preferences->preferred_models))
                                            @foreach($preferences->preferred_models as $model)
                                                <option value="{{ $model }}" selected>{{ $model }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <p class="mt-1 text-xs text-gray-500">{{ __('Select makes first to load available models') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Save Preferences') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const makesSelect = document.getElementById('preferred_makes');
            const modelsSelect = document.getElementById('preferred_models');
            
            // Function to load models for selected makes
            function loadModels() {
                const selectedMakes = Array.from(makesSelect.selectedOptions).map(option => option.value);
                
                // Clear current models except those already selected
                const selectedModels = Array.from(modelsSelect.selectedOptions).map(option => option.value);
                
                if (selectedMakes.length > 0) {
                    // For each selected make, fetch models
                    selectedMakes.forEach(make => {
                        fetch(`{{ route('preferences.get-models') }}?make=${encodeURIComponent(make)}`)
                            .then(response => response.json())
                            .then(models => {
                                models.forEach(model => {
                                    // Check if option already exists
                                    if (!Array.from(modelsSelect.options).some(option => option.value === model)) {
                                        const option = new Option(model, model, false, selectedModels.includes(model));
                                        modelsSelect.add(option);
                                    }
                                });
                            });
                    });
                }
            }
            
            // Load models when makes selection changes
            makesSelect.addEventListener('change', loadModels);
            
            // Initial load of models for pre-selected makes
            loadModels();
        });
    </script>
    @endpush
</x-app-layout>
