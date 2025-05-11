<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $report->title }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('reports.export.pdf', $report) }}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-800 transition ease-in-out duration-150">
                    <i class="fas fa-file-pdf mr-2"></i> {{ __('Export PDF') }}
                </a>
                <a href="{{ route('reports.export.excel', $report) }}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-800 transition ease-in-out duration-150">
                    <i class="fas fa-file-excel mr-2"></i> {{ __('Export Excel') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('info'))
                <div class="mb-4 bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('info') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">{{ $report->reportType->name }}</h3>
                            <p class="text-sm text-gray-600">{{ __('Generated') }}: {{ $report->generated_at->format('M d, Y H:i') }}</p>
                        </div>
                        <div class="text-sm text-gray-600">
                            <p><strong>{{ __('Filters') }}:</strong></p>
                            <ul>
                                @if (!empty($report->filters['selected_cars']))
                                    <li class="mb-2">
                                        <strong>{{ __('Selected Cars') }}:</strong>
                                        <div class="mt-1 flex flex-wrap gap-1">
                                            @if (!empty($report->filters['selected_car_details']))
                                                @foreach($report->filters['selected_car_details'] as $carId => $carName)
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        {{ $carName }}
                                                    </span>
                                                @endforeach
                                            @else
                                                <span class="text-gray-500">{{ count($report->filters['selected_cars']) }} {{ __('cars selected') }}</span>
                                            @endif
                                        </div>
                                    </li>
                                @endif

                                @if (!empty($report->filters['selected_user_name']))
                                    <li>{{ __('User') }}: {{ $report->filters['selected_user_name'] }}</li>
                                @endif

                                @if ($report->filters['date_range'] === 'custom')
                                    <li>{{ __('Date Range') }}: {{ \Carbon\Carbon::parse($report->filters['start_date'])->format('M d, Y') }} - {{ \Carbon\Carbon::parse($report->filters['end_date'])->format('M d, Y') }}</li>
                                @else
                                    <li>{{ __('Date Range') }}: {{ ucfirst(str_replace('_', ' ', $report->filters['date_range'])) }}</li>
                                @endif

                                @if (!empty($report->filters['make']))
                                    <li>{{ __('Make') }}: {{ $report->filters['make'] }}</li>
                                @endif

                                @if (!empty($report->filters['year']))
                                    <li>{{ __('Year') }}: {{ $report->filters['year'] }}</li>
                                @endif

                                @if (!empty($report->filters['phase']))
                                    <li>{{ __('Phase') }}: {{ ucfirst($report->filters['phase']) }}</li>
                                @endif
                            </ul>
                        </div>
                    </div>

                    <!-- Report Content -->
                    <div class="report-content">
                        @if ($report->reportType->slug === 'profitability-analysis')
                            @include('reports.partials.profitability')
                        @elseif ($report->reportType->slug === 'repair-cost-analysis')
                            @include('reports.partials.repair-cost')
                        @elseif ($report->reportType->slug === 'sales-performance')
                            @include('reports.partials.sales-performance')
                        @elseif ($report->reportType->slug === 'time-at-dealership')
                            @include('reports.partials.time-at-dealership')
                        @elseif ($report->reportType->slug === 'investment-summary')
                            @include('reports.partials.investment-summary')
                        @else
                            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4" role="alert">
                                <p>{{ __('Unknown report type or no data available.') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('reports.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-400 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    {{ __('Back to Reports') }}
                </a>

                <form action="{{ route('reports.destroy', $report) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this report?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">
                        <i class="fas fa-trash-alt mr-2"></i> {{ __('Delete Report') }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize charts if they exist
            const chartCanvases = document.querySelectorAll('.chart-canvas');
            chartCanvases.forEach(canvas => {
                const chartType = canvas.getAttribute('data-chart-type');
                const chartData = JSON.parse(canvas.getAttribute('data-chart-data'));
                const chartOptions = JSON.parse(canvas.getAttribute('data-chart-options'));

                new Chart(canvas, {
                    type: chartType,
                    data: chartData,
                    options: chartOptions
                });
            });
        });
    </script>
    @endpush
</x-app-layout>
