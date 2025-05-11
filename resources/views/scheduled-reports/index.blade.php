<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Scheduled Reports') }}
            </h2>
            <a href="{{ route('scheduled-reports.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-800 transition ease-in-out duration-150">
                <i class="fas fa-plus mr-2"></i> {{ __('Create Scheduled Report') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif

                    @if ($scheduledReports->isEmpty())
                        <div class="text-center py-8">
                            <i class="fas fa-calendar-alt text-gray-400 text-5xl mb-4"></i>
                            <p class="text-gray-500 text-lg">{{ __('No scheduled reports found.') }}</p>
                            <p class="text-gray-400 mt-2">{{ __('Create your first scheduled report to receive automated reports.') }}</p>
                            <a href="{{ route('scheduled-reports.create') }}" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-800 transition ease-in-out duration-150">
                                <i class="fas fa-plus mr-2"></i> {{ __('Create Scheduled Report') }}
                            </a>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Name') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Report Type') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Frequency') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Next Run') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Status') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Actions') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($scheduledReports as $scheduledReport)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $scheduledReport->name }}
                                                </div>
                                                @if (Auth::user()->hasAdminAccess() && isset($scheduledReport->user))
                                                    <div class="text-sm text-gray-500">
                                                        {{ __('By') }}: {{ $scheduledReport->user->name }}
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
                                                    <i class="fas {{ $scheduledReport->reportType->icon }} mr-1"></i>
                                                    {{ $scheduledReport->reportType->name }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
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
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
                                                    @if ($scheduledReport->next_run_at)
                                                        {{ $scheduledReport->next_run_at->format('M d, Y H:i') }}
                                                    @else
                                                        <span class="text-gray-500">{{ __('Not scheduled') }}</span>
                                                    @endif
                                                </div>
                                                @if ($scheduledReport->last_run_at)
                                                    <div class="text-xs text-gray-500">
                                                        {{ __('Last run') }}: {{ $scheduledReport->last_run_at->format('M d, Y H:i') }}
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if ($scheduledReport->is_active)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                        {{ __('Active') }}
                                                    </span>
                                                @else
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                        {{ __('Inactive') }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('scheduled-reports.show', $scheduledReport) }}" class="text-blue-600 hover:text-blue-900" title="{{ __('View') }}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('scheduled-reports.edit', $scheduledReport) }}" class="text-indigo-600 hover:text-indigo-900" title="{{ __('Edit') }}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('scheduled-reports.toggle-active', $scheduledReport) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="{{ $scheduledReport->is_active ? 'text-yellow-600 hover:text-yellow-900' : 'text-green-600 hover:text-green-900' }}" title="{{ $scheduledReport->is_active ? __('Deactivate') : __('Activate') }}">
                                                            <i class="fas {{ $scheduledReport->is_active ? 'fa-pause' : 'fa-play' }}"></i>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('scheduled-reports.destroy', $scheduledReport) }}" method="POST" class="inline" onsubmit="return confirm('{{ __('Are you sure you want to delete this scheduled report?') }}');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900" title="{{ __('Delete') }}">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $scheduledReports->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
