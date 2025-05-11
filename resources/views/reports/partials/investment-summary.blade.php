<div class="investment-summary-report">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <h4 class="text-lg font-medium text-gray-900 mb-2">{{ __('Total Cars') }}</h4>
            <p class="text-3xl font-bold text-indigo-600">{{ $report->data['total_cars'] }}</p>
            <div class="flex justify-between mt-2 text-sm">
                <span class="text-gray-600">{{ __('Sold') }}: <span class="font-medium">{{ $report->data['sold_cars'] }}</span></span>
                <span class="text-gray-600">{{ __('Unsold') }}: <span class="font-medium">{{ $report->data['unsold_cars'] }}</span></span>
            </div>
        </div>

        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <h4 class="text-lg font-medium text-gray-900 mb-2">{{ __('Total Investment') }}</h4>
            <p class="text-3xl font-bold text-indigo-600">
                @zar($report->data['total_investment'])
            </p>
        </div>

        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <h4 class="text-lg font-medium text-gray-900 mb-2">{{ __('Potential ROI') }}</h4>
            <p class="text-3xl font-bold {{ $report->data['roi_percentage'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                {{ number_format($report->data['roi_percentage'], 2) }}%
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <!-- Investment by Category Chart -->
        <div class="bg-white p-4 rounded-lg border border-gray-200">
            <h4 class="text-lg font-medium text-gray-900 mb-4">{{ __('Investment by Category') }}</h4>
            <div class="h-64">
                <canvas id="investmentByCategoryChart" class="chart-canvas"
                    data-chart-type="pie"
                    data-chart-data='{
                        "labels": [
                            "{{ __('Purchase') }}",
                            "{{ __('Parts') }}",
                            "{{ __('Labor') }}",
                            "{{ __('Painting') }}",
                            "{{ __('Transportation') }}",
                            "{{ __('Registration') }}",
                            "{{ __('Number Plates') }}",
                            "{{ __('Other') }}"
                        ],
                        "datasets": [
                            {
                                "data": [
                                    {{ $report->data['investment_by_category']['purchase'] }},
                                    {{ $report->data['investment_by_category']['parts'] }},
                                    {{ $report->data['investment_by_category']['labor'] }},
                                    {{ $report->data['investment_by_category']['painting'] }},
                                    {{ $report->data['investment_by_category']['transportation'] }},
                                    {{ $report->data['investment_by_category']['registration'] }},
                                    {{ $report->data['investment_by_category']['number_plates'] }},
                                    {{ $report->data['investment_by_category']['other'] }}
                                ],
                                "backgroundColor": [
                                    "rgba(99, 102, 241, 0.7)",
                                    "rgba(16, 185, 129, 0.7)",
                                    "rgba(245, 158, 11, 0.7)",
                                    "rgba(239, 68, 68, 0.7)",
                                    "rgba(59, 130, 246, 0.7)",
                                    "rgba(217, 70, 239, 0.7)",
                                    "rgba(251, 191, 36, 0.7)",
                                    "rgba(156, 163, 175, 0.7)"
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

        <!-- Investment vs Value Chart -->
        <div class="bg-white p-4 rounded-lg border border-gray-200">
            <h4 class="text-lg font-medium text-gray-900 mb-4">{{ __('Investment vs Potential Value') }}</h4>
            <div class="h-64">
                <canvas id="investmentVsValueChart" class="chart-canvas"
                    data-chart-type="bar"
                    data-chart-data='{
                        "labels": ["{{ __('Investment') }}", "{{ __('Potential Value') }}"],
                        "datasets": [
                            {
                                "label": "{{ __('Amount') }}",
                                "data": [
                                    {{ $report->data['total_investment'] }},
                                    {{ $report->data['potential_value'] }}
                                ],
                                "backgroundColor": [
                                    "rgba(99, 102, 241, 0.7)",
                                    "rgba(16, 185, 129, 0.7)"
                                ],
                                "borderColor": [
                                    "rgb(99, 102, 241)",
                                    "rgb(16, 185, 129)"
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

    <!-- Investment Summary Table -->
    <div class="bg-white p-4 rounded-lg border border-gray-200">
        <h4 class="text-lg font-medium text-gray-900 mb-4">{{ __('Investment Summary') }}</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h5 class="font-medium text-gray-900 mb-3">{{ __('Investment Breakdown') }}</h5>
                <table class="min-w-full">
                    <tbody>
                        <tr>
                            <td class="py-2 text-sm text-gray-600">{{ __('Purchase Cost') }}</td>
                            <td class="py-2 text-sm text-gray-900 text-right">@zar($report->data['investment_by_category']['purchase'])</td>
                        </tr>
                        <tr>
                            <td class="py-2 text-sm text-gray-600">{{ __('Parts Cost') }}</td>
                            <td class="py-2 text-sm text-gray-900 text-right">@zar($report->data['investment_by_category']['parts'])</td>
                        </tr>
                        <tr>
                            <td class="py-2 text-sm text-gray-600">{{ __('Labor Cost') }}</td>
                            <td class="py-2 text-sm text-gray-900 text-right">@zar($report->data['investment_by_category']['labor'])</td>
                        </tr>
                        <tr>
                            <td class="py-2 text-sm text-gray-600">{{ __('Painting Cost') }}</td>
                            <td class="py-2 text-sm text-gray-900 text-right">@zar($report->data['investment_by_category']['painting'])</td>
                        </tr>
                        <tr>
                            <td class="py-2 text-sm text-gray-600">{{ __('Transportation Cost') }}</td>
                            <td class="py-2 text-sm text-gray-900 text-right">@zar($report->data['investment_by_category']['transportation'])</td>
                        </tr>
                        <tr>
                            <td class="py-2 text-sm text-gray-600">{{ __('Registration Cost') }}</td>
                            <td class="py-2 text-sm text-gray-900 text-right">@zar($report->data['investment_by_category']['registration'])</td>
                        </tr>
                        <tr>
                            <td class="py-2 text-sm text-gray-600">{{ __('Number Plates Cost') }}</td>
                            <td class="py-2 text-sm text-gray-900 text-right">@zar($report->data['investment_by_category']['number_plates'])</td>
                        </tr>
                        <tr>
                            <td class="py-2 text-sm text-gray-600">{{ __('Other Costs') }}</td>
                            <td class="py-2 text-sm text-gray-900 text-right">@zar($report->data['investment_by_category']['other'])</td>
                        </tr>
                        <tr class="border-t border-gray-200">
                            <td class="py-2 text-sm font-medium text-gray-900">{{ __('Total Investment') }}</td>
                            <td class="py-2 text-sm font-medium text-gray-900 text-right">@zar($report->data['total_investment'])</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div>
                <h5 class="font-medium text-gray-900 mb-3">{{ __('Value & Profit Analysis') }}</h5>
                <table class="min-w-full">
                    <tbody>
                        <tr>
                            <td class="py-2 text-sm text-gray-600">{{ __('Revenue from Sold Cars') }}</td>
                            <td class="py-2 text-sm text-gray-900 text-right">@zar($report->data['total_revenue'])</td>
                        </tr>
                        <tr>
                            <td class="py-2 text-sm text-gray-600">{{ __('Estimated Value of Unsold Cars') }}</td>
                            <td class="py-2 text-sm text-gray-900 text-right">@zar($report->data['estimated_value'])</td>
                        </tr>
                        <tr class="border-t border-gray-200">
                            <td class="py-2 text-sm font-medium text-gray-900">{{ __('Potential Total Value') }}</td>
                            <td class="py-2 text-sm font-medium text-gray-900 text-right">@zar($report->data['potential_value'])</td>
                        </tr>
                        <tr class="border-t border-gray-200">
                            <td class="py-2 text-sm font-medium text-gray-900">{{ __('Potential Profit') }}</td>
                            <td class="py-2 text-sm font-medium {{ $report->data['potential_profit'] >= 0 ? 'text-green-600' : 'text-red-600' }} text-right">
                                @zar($report->data['potential_profit'])
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 text-sm font-medium text-gray-900">{{ __('ROI Percentage') }}</td>
                            <td class="py-2 text-sm font-medium {{ $report->data['roi_percentage'] >= 0 ? 'text-green-600' : 'text-red-600' }} text-right">
                                {{ number_format($report->data['roi_percentage'], 2) }}%
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="mt-6">
                    <h5 class="font-medium text-gray-900 mb-3">{{ __('Inventory Status') }}</h5>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gray-50 p-3 rounded-lg border border-gray-200">
                            <p class="text-sm text-gray-600">{{ __('Sold Cars') }}</p>
                            <p class="text-xl font-medium text-gray-900">{{ $report->data['sold_cars'] }}</p>
                        </div>
                        <div class="bg-gray-50 p-3 rounded-lg border border-gray-200">
                            <p class="text-sm text-gray-600">{{ __('Unsold Cars') }}</p>
                            <p class="text-xl font-medium text-gray-900">{{ $report->data['unsold_cars'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
