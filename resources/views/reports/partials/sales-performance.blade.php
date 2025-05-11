<div class="sales-performance-report">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <h4 class="text-lg font-medium text-gray-900 mb-2">{{ __('Total Cars Sold') }}</h4>
            <p class="text-3xl font-bold text-indigo-600">{{ $report->data['total_cars_sold'] }}</p>
        </div>

        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <h4 class="text-lg font-medium text-gray-900 mb-2">{{ __('Total Revenue') }}</h4>
            <p class="text-3xl font-bold text-green-600">
                @zar($report->data['total_revenue'])
            </p>
        </div>

        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <h4 class="text-lg font-medium text-gray-900 mb-2">{{ __('Average Selling Price') }}</h4>
            <p class="text-3xl font-bold text-indigo-600">
                @zar($report->data['avg_selling_price'])
            </p>
        </div>
    </div>

    <!-- Average Time to Sell -->
    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 mb-6">
        <h4 class="text-lg font-medium text-gray-900 mb-2">{{ __('Average Time to Sell') }}</h4>
        <p class="text-3xl font-bold text-indigo-600">
            {{ number_format($report->data['avg_time_to_sell'], 1) }} {{ __('days') }}
        </p>
        <p class="text-sm text-gray-600 mt-2">
            {{ __('Average number of days from when a car enters the dealership phase until it is sold.') }}
        </p>
    </div>

    <!-- Sales by Month Chart -->
    <div class="bg-white p-4 rounded-lg border border-gray-200 mb-6">
        <h4 class="text-lg font-medium text-gray-900 mb-4">{{ __('Sales by Month') }}</h4>
        <div class="h-80">
            <canvas id="salesByMonthChart" class="chart-canvas"
                data-chart-type="line"
                data-chart-data='{
                    "labels": [{{ implode(', ', array_map(function($month) { return "\"" . date("M Y", strtotime($month . "-01")) . "\""; }, array_keys($report->data['by_month']))) }}],
                    "datasets": [
                        {
                            "label": "{{ __('Number of Cars Sold') }}",
                            "data": [{{ implode(', ', array_map(function($month) { return $month['count']; }, $report->data['by_month'])) }}],
                            "backgroundColor": "rgba(99, 102, 241, 0.2)",
                            "borderColor": "rgb(99, 102, 241)",
                            "borderWidth": 2,
                            "tension": 0.1,
                            "yAxisID": "y"
                        },
                        {
                            "label": "{{ __('Revenue') }}",
                            "data": [{{ implode(', ', array_map(function($month) { return $month['total_revenue']; }, $report->data['by_month'])) }}],
                            "backgroundColor": "rgba(16, 185, 129, 0.2)",
                            "borderColor": "rgb(16, 185, 129)",
                            "borderWidth": 2,
                            "tension": 0.1,
                            "yAxisID": "y1"
                        }
                    ]
                }'
                data-chart-options='{
                    "responsive": true,
                    "maintainAspectRatio": false,
                    "scales": {
                        "y": {
                            "type": "linear",
                            "display": true,
                            "position": "left",
                            "title": {
                                "display": true,
                                "text": "{{ __('Cars Sold') }}"
                            },
                            "beginAtZero": true
                        },
                        "y1": {
                            "type": "linear",
                            "display": true,
                            "position": "right",
                            "title": {
                                "display": true,
                                "text": "{{ __('Revenue') }}"
                            },
                            "beginAtZero": true,
                            "grid": {
                                "drawOnChartArea": false
                            },
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

    <!-- Sales by Month Table -->
    <div class="bg-white p-4 rounded-lg border border-gray-200">
        <h4 class="text-lg font-medium text-gray-900 mb-4">{{ __('Monthly Sales Details') }}</h4>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Month') }}</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Cars Sold') }}</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Total Revenue') }}</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Average Price') }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($report->data['by_month'] as $month => $data)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ date("F Y", strtotime($month . "-01")) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $data['count'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">@zar($data['total_revenue'])</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">@zar($data['avg_price'])</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-gray-50">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ __('Total') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $report->data['total_cars_sold'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">@zar($report->data['total_revenue'])</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">@zar($report->data['avg_selling_price'])</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
