<div class="time-at-dealership-report">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <h4 class="text-lg font-medium text-gray-900 mb-2">{{ __('Total Cars') }}</h4>
            <p class="text-3xl font-bold text-indigo-600">{{ $report->data['total_cars'] }}</p>
            <div class="flex justify-between mt-2 text-sm">
                <span class="text-gray-600">{{ __('Sold') }}: <span class="font-medium">{{ $report->data['sold_count'] }}</span></span>
                <span class="text-gray-600">{{ __('Unsold') }}: <span class="font-medium">{{ $report->data['unsold_count'] }}</span></span>
            </div>
        </div>
        
        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <h4 class="text-lg font-medium text-gray-900 mb-2">{{ __('Average Days at Dealership') }}</h4>
            <p class="text-3xl font-bold text-indigo-600">
                {{ number_format($report->data['avg_days_at_dealership'], 1) }} {{ __('days') }}
            </p>
        </div>
        
        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <h4 class="text-lg font-medium text-gray-900 mb-2">{{ __('Cars at Dealership > 90 Days') }}</h4>
            <p class="text-3xl font-bold {{ $report->data['day_ranges']['90+'] > 0 ? 'text-red-600' : 'text-green-600' }}">
                {{ $report->data['day_ranges']['90+'] }}
            </p>
            <p class="text-sm text-gray-600 mt-2">
                {{ number_format(($report->data['day_ranges']['90+'] / $report->data['total_cars']) * 100, 1) }}% {{ __('of total inventory') }}
            </p>
        </div>
    </div>
    
    <!-- Days at Dealership Distribution Chart -->
    <div class="bg-white p-4 rounded-lg border border-gray-200 mb-6">
        <h4 class="text-lg font-medium text-gray-900 mb-4">{{ __('Days at Dealership Distribution') }}</h4>
        <div class="h-64">
            <canvas id="daysDistributionChart" class="chart-canvas" 
                data-chart-type="bar"
                data-chart-data='{
                    "labels": ["0-30 {{ __('days') }}", "31-60 {{ __('days') }}", "61-90 {{ __('days') }}", "90+ {{ __('days') }}"],
                    "datasets": [
                        {
                            "label": "{{ __('Number of Cars') }}",
                            "data": [
                                {{ $report->data['day_ranges']['0-30'] }},
                                {{ $report->data['day_ranges']['31-60'] }},
                                {{ $report->data['day_ranges']['61-90'] }},
                                {{ $report->data['day_ranges']['90+'] }}
                            ],
                            "backgroundColor": [
                                "rgba(16, 185, 129, 0.7)",
                                "rgba(245, 158, 11, 0.7)",
                                "rgba(249, 115, 22, 0.7)",
                                "rgba(239, 68, 68, 0.7)"
                            ],
                            "borderColor": [
                                "rgb(16, 185, 129)",
                                "rgb(245, 158, 11)",
                                "rgb(249, 115, 22)",
                                "rgb(239, 68, 68)"
                            ],
                            "borderWidth": 1
                        }
                    ]
                }'
                data-chart-options='{
                    "responsive": true,
                    "maintainAspectRatio": false,
                    "scales": {
                        "y": {
                            "beginAtZero": true,
                            "title": {
                                "display": true,
                                "text": "{{ __('Number of Cars') }}"
                            }
                        }
                    }
                }'
            ></canvas>
        </div>
    </div>
    
    <!-- Cars at Dealership Table -->
    <div class="bg-white p-4 rounded-lg border border-gray-200">
        <h4 class="text-lg font-medium text-gray-900 mb-4">{{ __('Cars at Dealership') }}</h4>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Make & Model') }}</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Year') }}</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Days at Dealership') }}</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Status') }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($report->data['cars'] as $car)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $car['make'] }} {{ $car['model'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $car['year'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <span class="
                                    {{ $car['days_at_dealership'] <= 30 ? 'text-green-600' : '' }}
                                    {{ $car['days_at_dealership'] > 30 && $car['days_at_dealership'] <= 60 ? 'text-yellow-600' : '' }}
                                    {{ $car['days_at_dealership'] > 60 && $car['days_at_dealership'] <= 90 ? 'text-orange-600' : '' }}
                                    {{ $car['days_at_dealership'] > 90 ? 'text-red-600' : '' }}
                                    font-medium
                                ">
                                    {{ $car['days_at_dealership'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if ($car['is_sold'])
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ __('Sold') }}
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ __('At Dealership') }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
