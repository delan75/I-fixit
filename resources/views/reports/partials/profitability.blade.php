<div class="profitability-report">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <h4 class="text-lg font-medium text-gray-900 mb-2">{{ __('Total Cars Sold') }}</h4>
            <p class="text-3xl font-bold text-indigo-600">{{ $report->data['total_cars'] }}</p>
        </div>

        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <h4 class="text-lg font-medium text-gray-900 mb-2">{{ __('Total Profit') }}</h4>
            <p class="text-3xl font-bold {{ $report->data['total_profit'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                @zar($report->data['total_profit'])
            </p>
        </div>

        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <h4 class="text-lg font-medium text-gray-900 mb-2">{{ __('Average ROI') }}</h4>
            <p class="text-3xl font-bold {{ $report->data['avg_roi'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                {{ number_format($report->data['avg_roi'], 2) }}%
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <!-- Profit by Make Chart -->
        <div class="bg-white p-4 rounded-lg border border-gray-200">
            <h4 class="text-lg font-medium text-gray-900 mb-4">{{ __('Profit by Make') }}</h4>
            <div class="h-64">
                <canvas id="profitByMakeChart" class="chart-canvas"
                    data-chart-type="bar"
                    data-chart-data='{
                        "labels": [{{ implode(', ', array_map(function($make) { return "\"$make\""; }, array_keys($report->data['by_make']))) }}],
                        "datasets": [
                            {
                                "label": "{{ __('Total Profit') }}",
                                "data": [{{ implode(', ', array_map(function($make) { return $make['total_profit']; }, $report->data['by_make'])) }}],
                                "backgroundColor": "rgba(99, 102, 241, 0.5)",
                                "borderColor": "rgb(99, 102, 241)",
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
                                "ticks": {
                                    "callback": function(value) {
                                        return "R " + value.toLocaleString();
                                    }
                                }
                            }
                        }
                    }'
                ></canvas>
            </div>
        </div>

        <!-- Profit by Year Chart -->
        <div class="bg-white p-4 rounded-lg border border-gray-200">
            <h4 class="text-lg font-medium text-gray-900 mb-4">{{ __('Profit by Year') }}</h4>
            <div class="h-64">
                <canvas id="profitByYearChart" class="chart-canvas"
                    data-chart-type="bar"
                    data-chart-data='{
                        "labels": [{{ implode(', ', array_map(function($year) { return "\"$year\""; }, array_keys($report->data['by_year']))) }}],
                        "datasets": [
                            {
                                "label": "{{ __('Total Profit') }}",
                                "data": [{{ implode(', ', array_map(function($year) { return $year['total_profit']; }, $report->data['by_year'])) }}],
                                "backgroundColor": "rgba(16, 185, 129, 0.5)",
                                "borderColor": "rgb(16, 185, 129)",
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
                                "ticks": {
                                    "callback": function(value) {
                                        return "R " + value.toLocaleString();
                                    }
                                }
                            }
                        }
                    }'
                ></canvas>
            </div>
        </div>
    </div>

    <!-- Detailed Profit by Make Table -->
    <div class="bg-white p-4 rounded-lg border border-gray-200 mb-6">
        <h4 class="text-lg font-medium text-gray-900 mb-4">{{ __('Detailed Profit by Make') }}</h4>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Make') }}</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Cars Sold') }}</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Total Profit') }}</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Average Profit') }}</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Average ROI') }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($report->data['by_make'] as $make => $data)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $make }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $data['count'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">@zar($data['total_profit'])</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">@zar($data['avg_profit'])</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ number_format($data['avg_roi'], 2) }}%</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
