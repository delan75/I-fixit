<div class="repair-cost-report">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <h4 class="text-lg font-medium text-gray-900 mb-2">{{ __('Total Cars') }}</h4>
            <p class="text-3xl font-bold text-indigo-600">{{ $report->data['total_cars'] }}</p>
        </div>

        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <h4 class="text-lg font-medium text-gray-900 mb-2">{{ __('Total Repair Cost') }}</h4>
            <p class="text-3xl font-bold text-indigo-600">
                @zar($report->data['cost_by_category']['parts'] + $report->data['cost_by_category']['labor'] + $report->data['cost_by_category']['painting'])
            </p>
        </div>

        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <h4 class="text-lg font-medium text-gray-900 mb-2">{{ __('Average Repair Cost') }}</h4>
            <p class="text-3xl font-bold text-indigo-600">
                @zar($report->data['avg_repair_cost'])
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <!-- Repair Costs by Category Chart -->
        <div class="bg-white p-4 rounded-lg border border-gray-200">
            <h4 class="text-lg font-medium text-gray-900 mb-4">{{ __('Repair Costs by Category') }}</h4>
            <div class="h-64">
                <canvas id="repairCostsByCategoryChart" class="chart-canvas"
                    data-chart-type="pie"
                    data-chart-data='{
                        "labels": ["{{ __('Parts') }}", "{{ __('Labor') }}", "{{ __('Painting') }}"],
                        "datasets": [
                            {
                                "data": [
                                    {{ $report->data['cost_by_category']['parts'] }},
                                    {{ $report->data['cost_by_category']['labor'] }},
                                    {{ $report->data['cost_by_category']['painting'] }}
                                ],
                                "backgroundColor": [
                                    "rgba(99, 102, 241, 0.7)",
                                    "rgba(16, 185, 129, 0.7)",
                                    "rgba(245, 158, 11, 0.7)"
                                ],
                                "borderColor": [
                                    "rgb(99, 102, 241)",
                                    "rgb(16, 185, 129)",
                                    "rgb(245, 158, 11)"
                                ],
                                "borderWidth": 1
                            }
                        ]
                    }'
                    data-chart-options='{
                        "responsive": true,
                        "maintainAspectRatio": false,
                        "plugins": {
                            "tooltip": {
                                "callbacks": {
                                    "label": function(context) {
                                        var label = context.label || "";
                                        var value = context.raw || 0;
                                        var total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        var percentage = Math.round((value / total) * 100);
                                        return label + ": R " + value.toLocaleString() + " (" + percentage + "%)";
                                    }
                                }
                            }
                        }
                    }'
                ></canvas>
            </div>
        </div>

        <!-- Estimated vs Actual Repair Costs Chart -->
        <div class="bg-white p-4 rounded-lg border border-gray-200">
            <h4 class="text-lg font-medium text-gray-900 mb-4">{{ __('Estimated vs Actual Repair Costs') }}</h4>
            <div class="h-64">
                <canvas id="estimatedVsActualChart" class="chart-canvas"
                    data-chart-type="bar"
                    data-chart-data='{
                        "labels": ["{{ __('Estimated') }}", "{{ __('Actual') }}"],
                        "datasets": [
                            {
                                "label": "{{ __('Repair Costs') }}",
                                "data": [
                                    {{ $report->data['estimated_vs_actual']['estimated'] }},
                                    {{ $report->data['estimated_vs_actual']['actual'] }}
                                ],
                                "backgroundColor": [
                                    "rgba(16, 185, 129, 0.7)",
                                    "rgba(99, 102, 241, 0.7)"
                                ],
                                "borderColor": [
                                    "rgb(16, 185, 129)",
                                    "rgb(99, 102, 241)"
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

    <!-- Estimated vs Actual Summary -->
    <div class="bg-white p-4 rounded-lg border border-gray-200 mb-6">
        <h4 class="text-lg font-medium text-gray-900 mb-4">{{ __('Estimated vs Actual Summary') }}</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-600 mb-1">{{ __('Estimated Repair Cost') }}: <span class="font-medium">@zar($report->data['estimated_vs_actual']['estimated'])</span></p>
                <p class="text-sm text-gray-600 mb-1">{{ __('Actual Repair Cost') }}: <span class="font-medium">@zar($report->data['estimated_vs_actual']['actual'])</span></p>
                <p class="text-sm text-gray-600 mb-1">{{ __('Difference') }}:
                    <span class="font-medium {{ $report->data['estimated_vs_actual']['difference'] <= 0 ? 'text-green-600' : 'text-red-600' }}">
                        @zar(abs($report->data['estimated_vs_actual']['difference']))
                        ({{ $report->data['estimated_vs_actual']['difference'] <= 0 ? 'under budget' : 'over budget' }})
                    </span>
                </p>
                <p class="text-sm text-gray-600">{{ __('Percentage Difference') }}:
                    <span class="font-medium {{ $report->data['estimated_vs_actual']['percentage_difference'] <= 0 ? 'text-green-600' : 'text-red-600' }}">
                        {{ number_format(abs($report->data['estimated_vs_actual']['percentage_difference']), 2) }}%
                    </span>
                </p>
            </div>
            <div>
                <p class="text-sm text-gray-600 mb-1">{{ __('Parts Cost') }}: <span class="font-medium">@zar($report->data['cost_by_category']['parts'])</span></p>
                <p class="text-sm text-gray-600 mb-1">{{ __('Labor Cost') }}: <span class="font-medium">@zar($report->data['cost_by_category']['labor'])</span></p>
                <p class="text-sm text-gray-600">{{ __('Painting Cost') }}: <span class="font-medium">@zar($report->data['cost_by_category']['painting'])</span></p>
            </div>
        </div>
    </div>

    <!-- Most Common Damaged Parts -->
    @if (count($report->data['common_damaged_parts']) > 0)
    <div class="bg-white p-4 rounded-lg border border-gray-200">
        <h4 class="text-lg font-medium text-gray-900 mb-4">{{ __('Most Common Damaged Parts') }}</h4>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Part Name') }}</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Count') }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($report->data['common_damaged_parts'] as $part)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $part['part_name'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $part['count'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
