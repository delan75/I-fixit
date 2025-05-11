<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reports') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900 mb-5">{{ __('Select a Report Type to Generate') }}</h3>
                    <p class="text-gray-600 mb-6">Click on any of the green "Generate Report" buttons below to create a new report.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($reportTypes as $reportType)
                            <div class="bg-white p-6 rounded-lg border border-gray-200 shadow hover:shadow-lg transition-all">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 flex items-center justify-center bg-green-100 rounded-full mr-3">
                                        <i class="fas {{ $reportType->icon }} text-green-600 text-xl"></i>
                                    </div>
                                    <h4 class="text-lg font-semibold text-gray-900">{{ $reportType->name }}</h4>
                                </div>
                                <p class="text-sm text-gray-600 mb-5 h-12">{{ $reportType->description }}</p>
                                <a href="{{ route('reports.create', ['type' => $reportType->id]) }}"
                                   class="w-full inline-flex items-center justify-center px-4 py-3 bg-green-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-800 focus:outline-none focus:border-green-800 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150 shadow-sm">
                                    <i class="fas fa-plus-circle mr-2"></i>
                                    {{ __('Generate Report') }}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            @if ($recentReports->count() > 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Recent Reports') }}</h3>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Title') }}</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Type') }}</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Generated') }}</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($recentReports as $report)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $report->title }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $report->reportType->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $report->generated_at->diffForHumans() }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('reports.show', $report) }}" class="inline-flex items-center px-3 py-1.5 bg-indigo-100 border border-indigo-200 rounded-md text-xs font-medium text-indigo-700 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                        <i class="fas fa-eye mr-1.5"></i>{{ __('View') }}
                                                    </a>
                                                    <a href="{{ route('reports.export.pdf', $report) }}" class="inline-flex items-center px-3 py-1.5 bg-green-100 border border-green-200 rounded-md text-xs font-medium text-green-700 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                        <i class="fas fa-file-pdf mr-1.5"></i>{{ __('PDF') }}
                                                    </a>
                                                    <a href="{{ route('reports.export.excel', $report) }}" class="inline-flex items-center px-3 py-1.5 bg-blue-100 border border-blue-200 rounded-md text-xs font-medium text-blue-700 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                        <i class="fas fa-file-excel mr-1.5"></i>{{ __('Excel') }}
                                                    </a>
                                                    <form action="{{ route('reports.destroy', $report) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-100 border border-red-200 rounded-md text-xs font-medium text-red-700 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" onclick="return confirm('Are you sure you want to delete this report?')">
                                                            <i class="fas fa-trash-alt mr-1.5"></i>{{ __('Delete') }}
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
