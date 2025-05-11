<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Scheduled Report Details') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('scheduled-reports.edit', $scheduledReport) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-800 transition ease-in-out duration-150">
                    <i class="fas fa-edit mr-2"></i> {{ __('Edit') }}
                </a>
                <a href="{{ route('scheduled-reports.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
                    <i class="fas fa-arrow-left mr-2"></i> {{ __('Back to Scheduled Reports') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">{{ __('Report Information') }}</h3>
                            <div class="mt-4 bg-gray-50 p-4 rounded-lg">
                                <div class="grid grid-cols-1 gap-4">
                                    <div>
                                        <span class="text-sm font-medium text-gray-500">{{ __('Name') }}</span>
                                        <p class="mt-1 text-sm text-gray-900">{{ $scheduledReport->name }}</p>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium text-gray-500">{{ __('Report Type') }}</span>
                                        <p class="mt-1 text-sm text-gray-900">
                                            <i class="fas {{ $scheduledReport->reportType->icon }} mr-1"></i>
                                            {{ $scheduledReport->reportType->name }}
                                        </p>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium text-gray-500">{{ __('Status') }}</span>
                                        <p class="mt-1">
                                            @if ($scheduledReport->is_active)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    {{ __('Active') }}
                                                </span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                    {{ __('Inactive') }}
                                                </span>
                                            @endif
                                        </p>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium text-gray-500">{{ __('Created By') }}</span>
                                        <p class="mt-1 text-sm text-gray-900">{{ $scheduledReport->user->name }}</p>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium text-gray-500">{{ __('Created At') }}</span>
                                        <p class="mt-1 text-sm text-gray-900">{{ $scheduledReport->created_at->format('M d, Y H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-900">{{ __('Schedule Information') }}</h3>
                            <div class="mt-4 bg-gray-50 p-4 rounded-lg">
                                <div class="grid grid-cols-1 gap-4">
                                    <div>
                                        <span class="text-sm font-medium text-gray-500">{{ __('Frequency') }}</span>
                                        <p class="mt-1 text-sm text-gray-900">
                                            @if ($scheduledReport->frequency === 'daily')
                                                <span class="inline-flex items-center">
                                                    <i class="fas fa-calendar-day mr-1"></i>
                                                    {{ __('Daily') }} at {{ \Carbon\Carbon::parse($scheduledReport->time)->format('H:i') }}
                                                </span>
                                            @elseif ($scheduledReport->frequency === 'weekly')
                                                <span class="inline-flex items-center">
                                                    <i class="fas fa-calendar-week mr-1"></i>
                                                    {{ __('Weekly') }} on {{ ucfirst($scheduledReport->day_of_week) }} at {{ \Carbon\Carbon::parse($scheduledReport->time)->format('H:i') }}
                                                </span>
                                            @elseif ($scheduledReport->frequency === 'monthly')
                                                <span class="inline-flex items-center">
                                                    <i class="fas fa-calendar-alt mr-1"></i>
                                                    {{ __('Monthly') }} on day {{ $scheduledReport->day_of_month }} at {{ \Carbon\Carbon::parse($scheduledReport->time)->format('H:i') }}
                                                </span>
                                            @endif
                                        </p>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium text-gray-500">{{ __('Next Run') }}</span>
                                        <p class="mt-1 text-sm text-gray-900">
                                            @if ($scheduledReport->next_run_at)
                                                {{ $scheduledReport->next_run_at->format('M d, Y H:i') }}
                                            @else
                                                <span class="text-gray-500">{{ __('Not scheduled') }}</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium text-gray-500">{{ __('Last Run') }}</span>
                                        <p class="mt-1 text-sm text-gray-900">
                                            @if ($scheduledReport->last_run_at)
                                                {{ $scheduledReport->last_run_at->format('M d, Y H:i') }}
                                            @else
                                                <span class="text-gray-500">{{ __('Never') }}</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium text-gray-500">{{ __('Export Format') }}</span>
                                        <p class="mt-1 text-sm text-gray-900">
                                            @if ($scheduledReport->export_format === 'pdf')
                                                <i class="fas fa-file-pdf mr-1"></i> PDF
                                            @elseif ($scheduledReport->export_format === 'xlsx')
                                                <i class="fas fa-file-excel mr-1"></i> Excel
                                            @elseif ($scheduledReport->export_format === 'csv')
                                                <i class="fas fa-file-csv mr-1"></i> CSV
                                            @endif
                                        </p>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium text-gray-500">{{ __('Recipients') }}</span>
                                        <p class="mt-1 text-sm text-gray-900">
                                            @if ($scheduledReport->recipients)
                                                @foreach(explode(',', $scheduledReport->recipients) as $recipient)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mr-1 mb-1">
                                                        <i class="fas fa-envelope mr-1"></i>
                                                        {{ trim($recipient) }}
                                                    </span>
                                                @endforeach
                                            @else
                                                <span class="text-gray-500">{{ __('No recipients (report will be generated but not sent)') }}</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h3 class="text-lg font-medium text-gray-900">{{ __('Report Filters') }}</h3>
                        <div class="mt-4 bg-gray-50 p-4 rounded-lg">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <span class="text-sm font-medium text-gray-500">{{ __('Date Range') }}</span>
                                    <p class="mt-1 text-sm text-gray-900">
                                        @if(isset($scheduledReport->filters['date_range']))
                                            @if($scheduledReport->filters['date_range'] === 'custom')
                                                {{ __('Custom Range') }}: 
                                                {{ \Carbon\Carbon::parse($scheduledReport->filters['start_date'])->format('M d, Y') }} - 
                                                {{ \Carbon\Carbon::parse($scheduledReport->filters['end_date'])->format('M d, Y') }}
                                            @else
                                                {{ ucfirst(str_replace('_', ' ', $scheduledReport->filters['date_range'])) }}
                                            @endif
                                        @else
                                            {{ __('All Time') }}
                                        @endif
                                    </p>
                                </div>
                                <div>
                                    <span class="text-sm font-medium text-gray-500">{{ __('Make') }}</span>
                                    <p class="mt-1 text-sm text-gray-900">
                                        {{ isset($scheduledReport->filters['make']) && $scheduledReport->filters['make'] ? $scheduledReport->filters['make'] : __('All Makes') }}
                                    </p>
                                </div>
                                <div>
                                    <span class="text-sm font-medium text-gray-500">{{ __('Model') }}</span>
                                    <p class="mt-1 text-sm text-gray-900">
                                        {{ isset($scheduledReport->filters['model']) && $scheduledReport->filters['model'] ? $scheduledReport->filters['model'] : __('All Models') }}
                                    </p>
                                </div>
                                <div>
                                    <span class="text-sm font-medium text-gray-500">{{ __('Year') }}</span>
                                    <p class="mt-1 text-sm text-gray-900">
                                        {{ isset($scheduledReport->filters['year']) && $scheduledReport->filters['year'] ? $scheduledReport->filters['year'] : __('All Years') }}
                                    </p>
                                </div>
                                <div>
                                    <span class="text-sm font-medium text-gray-500">{{ __('Phase') }}</span>
                                    <p class="mt-1 text-sm text-gray-900">
                                        {{ isset($scheduledReport->filters['phase']) && $scheduledReport->filters['phase'] ? ucfirst($scheduledReport->filters['phase']) : __('All Phases') }}
                                    </p>
                                </div>
                                <div>
                                    <span class="text-sm font-medium text-gray-500">{{ __('Selected Cars') }}</span>
                                    <p class="mt-1 text-sm text-gray-900">
                                        @if(isset($scheduledReport->filters['selected_cars']) && is_array($scheduledReport->filters['selected_cars']) && count($scheduledReport->filters['selected_cars']) > 0)
                                            {{ count($scheduledReport->filters['selected_cars']) }} {{ __('cars selected') }}
                                        @else
                                            {{ __('All Cars') }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end space-x-4">
                        <form action="{{ route('scheduled-reports.toggle-active', $scheduledReport) }}" method="POST" class="inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md {{ $scheduledReport->is_active ? 'text-white bg-yellow-600 hover:bg-yellow-700' : 'text-white bg-green-600 hover:bg-green-700' }} focus:outline-none focus:shadow-outline-indigo active:bg-indigo-800 transition ease-in-out duration-150">
                                <i class="fas {{ $scheduledReport->is_active ? 'fa-pause' : 'fa-play' }} mr-2"></i>
                                {{ $scheduledReport->is_active ? __('Deactivate') : __('Activate') }}
                            </button>
                        </form>
                        <form action="{{ route('scheduled-reports.destroy', $scheduledReport) }}" method="POST" class="inline" onsubmit="return confirm('{{ __('Are you sure you want to delete this scheduled report?') }}');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red active:bg-red-800 transition ease-in-out duration-150">
                                <i class="fas fa-trash mr-2"></i>
                                {{ __('Delete') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
