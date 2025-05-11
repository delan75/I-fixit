<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create Scheduled Report') }}
            </h2>
            <a href="{{ route('scheduled-reports.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
                <i class="fas fa-arrow-left mr-2"></i> {{ __('Back to Scheduled Reports') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('scheduled-reports.store') }}">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Report Name -->
                            <div>
                                <x-input-label for="name" :value="__('Report Name')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <!-- Report Type -->
                            <div>
                                <x-input-label for="report_type_id" :value="__('Report Type')" />
                                <select id="report_type_id" name="report_type_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                    <option value="">{{ __('Select Report Type') }}</option>
                                    @foreach ($reportTypes as $reportType)
                                        <option value="{{ $reportType->id }}" {{ old('report_type_id') == $reportType->id ? 'selected' : '' }}>
                                            {{ $reportType->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('report_type_id')" class="mt-2" />
                            </div>

                            <!-- Frequency -->
                            <div>
                                <x-input-label for="frequency" :value="__('Frequency')" />
                                <select id="frequency" name="frequency" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                    @foreach ($frequencies as $value => $label)
                                        <option value="{{ $value }}" {{ old('frequency') == $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('frequency')" class="mt-2" />
                            </div>

                            <!-- Time -->
                            <div>
                                <x-input-label for="time" :value="__('Time')" />
                                <x-text-input id="time" class="block mt-1 w-full" type="time" name="time" :value="old('time')" required />
                                <x-input-error :messages="$errors->get('time')" class="mt-2" />
                            </div>

                            <!-- Day of Week (for weekly reports) -->
                            <div id="day_of_week_container" class="{{ old('frequency') === 'weekly' ? '' : 'hidden' }}">
                                <x-input-label for="day_of_week" :value="__('Day of Week')" />
                                <select id="day_of_week" name="day_of_week" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @foreach ($daysOfWeek as $value => $label)
                                        <option value="{{ $value }}" {{ old('day_of_week') == $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('day_of_week')" class="mt-2" />
                            </div>

                            <!-- Day of Month (for monthly reports) -->
                            <div id="day_of_month_container" class="{{ old('frequency') === 'monthly' ? '' : 'hidden' }}">
                                <x-input-label for="day_of_month" :value="__('Day of Month')" />
                                <select id="day_of_month" name="day_of_month" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @foreach ($daysOfMonth as $value => $label)
                                        <option value="{{ $value }}" {{ old('day_of_month') == $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('day_of_month')" class="mt-2" />
                            </div>

                            <!-- Recipients -->
                            <div class="md:col-span-2">
                                <x-input-label for="recipients" :value="__('Recipients (comma-separated email addresses)')" />
                                <x-text-input id="recipients" class="block mt-1 w-full" type="text" name="recipients" :value="old('recipients')" placeholder="email1@example.com, email2@example.com" />
                                <x-input-error :messages="$errors->get('recipients')" class="mt-2" />
                                <p class="text-sm text-gray-500 mt-1">{{ __('Leave empty to only generate the report without sending emails.') }}</p>
                            </div>

                            <!-- Export Format -->
                            <div>
                                <x-input-label for="export_format" :value="__('Export Format')" />
                                <select id="export_format" name="export_format" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                    @foreach ($exportFormats as $value => $label)
                                        <option value="{{ $value }}" {{ old('export_format') == $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('export_format')" class="mt-2" />
                            </div>

                            <!-- Active Status -->
                            <div class="flex items-center mt-6">
                                <input id="is_active" name="is_active" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" {{ old('is_active') ? 'checked' : 'checked' }}>
                                <label for="is_active" class="ml-2 block text-sm text-gray-900">{{ __('Active') }}</label>
                            </div>
                        </div>

                        <div class="mt-8 border-t border-gray-200 pt-6">
                            <h3 class="text-lg font-medium text-gray-900">{{ __('Report Filters') }}</h3>
                            <p class="text-sm text-gray-500 mt-1">{{ __('Set filters to determine which cars will be included in the report.') }}</p>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                                <!-- Date Range -->
                                <div>
                                    <x-input-label for="date_range" :value="__('Date Range')" />
                                    <select id="date_range" name="date_range" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                        <option value="last_30_days" {{ old('date_range') == 'last_30_days' ? 'selected' : '' }}>{{ __('Last 30 Days') }}</option>
                                        <option value="last_90_days" {{ old('date_range') == 'last_90_days' ? 'selected' : '' }}>{{ __('Last 90 Days') }}</option>
                                        <option value="last_6_months" {{ old('date_range') == 'last_6_months' ? 'selected' : '' }}>{{ __('Last 6 Months') }}</option>
                                        <option value="last_year" {{ old('date_range') == 'last_year' ? 'selected' : '' }}>{{ __('Last Year') }}</option>
                                        <option value="all_time" {{ old('date_range') == 'all_time' ? 'selected' : '' }}>{{ __('All Time') }}</option>
                                        <option value="custom" {{ old('date_range') == 'custom' ? 'selected' : '' }}>{{ __('Custom Range') }}</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('date_range')" class="mt-2" />
                                </div>

                                <!-- Custom Date Range -->
                                <div id="custom_date_range" class="{{ old('date_range') === 'custom' ? '' : 'hidden' }} grid grid-cols-2 gap-4">
                                    <div>
                                        <x-input-label for="start_date" :value="__('Start Date')" />
                                        <x-text-input id="start_date" class="block mt-1 w-full" type="date" name="start_date" :value="old('start_date')" />
                                        <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                                    </div>
                                    <div>
                                        <x-input-label for="end_date" :value="__('End Date')" />
                                        <x-text-input id="end_date" class="block mt-1 w-full" type="date" name="end_date" :value="old('end_date')" />
                                        <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                                    </div>
                                </div>

                                <!-- Make -->
                                <div>
                                    <x-input-label for="make" :value="__('Make')" />
                                    <x-text-input id="make" class="block mt-1 w-full" type="text" name="make" :value="old('make')" />
                                    <x-input-error :messages="$errors->get('make')" class="mt-2" />
                                </div>

                                <!-- Model -->
                                <div>
                                    <x-input-label for="model" :value="__('Model')" />
                                    <x-text-input id="model" class="block mt-1 w-full" type="text" name="model" :value="old('model')" />
                                    <x-input-error :messages="$errors->get('model')" class="mt-2" />
                                </div>

                                <!-- Year -->
                                <div>
                                    <x-input-label for="year" :value="__('Year')" />
                                    <x-text-input id="year" class="block mt-1 w-full" type="number" name="year" :value="old('year')" min="1900" max="{{ date('Y') + 1 }}" />
                                    <x-input-error :messages="$errors->get('year')" class="mt-2" />
                                </div>

                                <!-- Phase -->
                                <div>
                                    <x-input-label for="phase" :value="__('Phase')" />
                                    <select id="phase" name="phase" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <option value="">{{ __('All Phases') }}</option>
                                        <option value="bidding" {{ old('phase') == 'bidding' ? 'selected' : '' }}>{{ __('Bidding') }}</option>
                                        <option value="fixing" {{ old('phase') == 'fixing' ? 'selected' : '' }}>{{ __('Fixing') }}</option>
                                        <option value="dealership" {{ old('phase') == 'dealership' ? 'selected' : '' }}>{{ __('Dealership') }}</option>
                                        <option value="sold" {{ old('phase') == 'sold' ? 'selected' : '' }}>{{ __('Sold') }}</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('phase')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button class="ml-3">
                                {{ __('Create Scheduled Report') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const frequencySelect = document.getElementById('frequency');
            const dayOfWeekContainer = document.getElementById('day_of_week_container');
            const dayOfMonthContainer = document.getElementById('day_of_month_container');
            const dateRangeSelect = document.getElementById('date_range');
            const customDateRange = document.getElementById('custom_date_range');

            // Handle frequency change
            frequencySelect.addEventListener('change', function() {
                if (this.value === 'weekly') {
                    dayOfWeekContainer.classList.remove('hidden');
                    dayOfMonthContainer.classList.add('hidden');
                } else if (this.value === 'monthly') {
                    dayOfWeekContainer.classList.add('hidden');
                    dayOfMonthContainer.classList.remove('hidden');
                } else {
                    dayOfWeekContainer.classList.add('hidden');
                    dayOfMonthContainer.classList.add('hidden');
                }
            });

            // Handle date range change
            dateRangeSelect.addEventListener('change', function() {
                if (this.value === 'custom') {
                    customDateRange.classList.remove('hidden');
                } else {
                    customDateRange.classList.add('hidden');
                }
            });
        });
    </script>
</x-app-layout>
