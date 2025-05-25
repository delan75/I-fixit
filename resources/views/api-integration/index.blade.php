<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('API Integration Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2" onclick="syncOpportunities()">
                                <i class="fas fa-sync-alt"></i> Sync Opportunities
                            </button>
                            <button type="button" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" onclick="triggerScraping()">
                                <i class="fas fa-spider"></i> Trigger Scraping
                            </button>
                        </div>
                    </div>

                    @if(isset($error))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            <i class="fas fa-exclamation-triangle"></i> {{ $error }}
                        </div>
                    @endif

                    <!-- API Status Card -->
                    <div class="mb-6">
                        <div class="bg-white border-l-4 {{ $apiStatus['status'] === 'online' ? 'border-green-500' : 'border-red-500' }} shadow rounded-lg">
                            <div class="p-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="text-xs font-bold {{ $apiStatus['status'] === 'online' ? 'text-green-600' : 'text-red-600' }} uppercase mb-1">
                                            API Status
                                        </div>
                                        <div class="text-xl font-bold text-gray-800">
                                            {{ ucfirst($apiStatus['status']) }}
                                            @if(isset($apiStatus['response_time']))
                                                <span class="text-sm text-gray-500">({{ number_format($apiStatus['response_time'] * 1000, 0) }}ms)</span>
                                            @endif
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            Last checked: {{ $apiStatus['last_checked']->format('Y-m-d H:i:s') }}
                                        </div>
                                    </div>
                                    <div>
                                        <i class="fas fa-{{ $apiStatus['status'] === 'online' ? 'check-circle' : 'times-circle' }} text-3xl {{ $apiStatus['status'] === 'online' ? 'text-green-500' : 'text-red-500' }}"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Statistics Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                        <div class="bg-white border-l-4 border-blue-500 shadow rounded-lg">
                            <div class="p-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="text-xs font-bold text-blue-600 uppercase mb-1">
                                            Total Opportunities
                                        </div>
                                        <div class="text-xl font-bold text-gray-800">{{ number_format($stats['total_opportunities']) }}</div>
                                    </div>
                                    <div>
                                        <i class="fas fa-list text-2xl text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white border-l-4 border-green-500 shadow rounded-lg">
                            <div class="p-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="text-xs font-bold text-green-600 uppercase mb-1">
                                            New Opportunities
                                        </div>
                                        <div class="text-xl font-bold text-gray-800">{{ number_format($stats['new_opportunities']) }}</div>
                                    </div>
                                    <div>
                                        <i class="fas fa-star text-2xl text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white border-l-4 border-indigo-500 shadow rounded-lg">
                            <div class="p-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="text-xs font-bold text-indigo-600 uppercase mb-1">
                                            High Score (80+)
                                        </div>
                                        <div class="text-xl font-bold text-gray-800">{{ number_format($stats['high_score_opportunities']) }}</div>
                                    </div>
                                    <div>
                                        <i class="fas fa-trophy text-2xl text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white border-l-4 border-yellow-500 shadow rounded-lg">
                            <div class="p-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="text-xs font-bold text-yellow-600 uppercase mb-1">
                                            Today's Opportunities
                                        </div>
                                        <div class="text-xl font-bold text-gray-800">{{ number_format($stats['opportunities_today']) }}</div>
                                    </div>
                                    <div>
                                        <i class="fas fa-calendar-day text-2xl text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- High Scoring Opportunities -->
                    <div class="mb-6">
                        <div class="bg-white shadow rounded-lg">
                            <div class="px-6 py-4 border-b border-gray-200">
                                <h3 class="text-lg font-semibold text-blue-600">High Scoring Opportunities (80+)</h3>
                            </div>
                            <div class="p-6">
                                @if($highScoringOpportunities->count() > 0)
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Score</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vehicle</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Source</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Current Bid</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Potential Profit</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Auction End</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                @foreach($highScoringOpportunities as $opportunity)
                                                    <tr>
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">{{ $opportunity->opportunity_score }}</span>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $opportunity->vehicle_description }}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $opportunity->source }}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">R{{ number_format($opportunity->current_bid, 2) }}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                            @if($opportunity->potential_profit)
                                                                <span class="{{ $opportunity->potential_profit > 0 ? 'text-green-600' : 'text-red-600' }}">
                                                                    R{{ number_format($opportunity->potential_profit, 2) }}
                                                                </span>
                                                            @else
                                                                <span class="text-gray-500">N/A</span>
                                                            @endif
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                            @if($opportunity->auction_end_date)
                                                                {{ $opportunity->auction_end_date->format('Y-m-d H:i') }}
                                                            @else
                                                                <span class="text-gray-500">N/A</span>
                                                            @endif
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $opportunity->status === 'new' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                                                                {{ ucfirst($opportunity->status) }}
                                                            </span>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                            <a href="{{ $opportunity->listing_url }}" target="_blank" class="text-blue-600 hover:text-blue-900">
                                                                <i class="fas fa-external-link-alt"></i> View
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="text-center py-8">
                                        <i class="fas fa-search text-4xl text-gray-300 mb-4"></i>
                                        <p class="text-gray-500">No high-scoring opportunities found.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Recent Opportunities -->
                    <div class="mb-6">
                        <div class="bg-white shadow rounded-lg">
                            <div class="px-6 py-4 border-b border-gray-200">
                                <h3 class="text-lg font-semibold text-blue-600">Recent Opportunities</h3>
                            </div>
                            <div class="p-6">
                                @if($recentOpportunities->count() > 0)
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Score</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vehicle</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Source</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Current Bid</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Added</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                @foreach($recentOpportunities as $opportunity)
                                                    <tr>
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                                                {{ $opportunity->opportunity_score >= 80 ? 'bg-green-100 text-green-800' :
                                                                   ($opportunity->opportunity_score >= 60 ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                                                {{ $opportunity->opportunity_score }}
                                                            </span>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $opportunity->vehicle_description }}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $opportunity->source }}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">R{{ number_format($opportunity->current_bid, 2) }}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $opportunity->status === 'new' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                                                                {{ ucfirst($opportunity->status) }}
                                                            </span>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $opportunity->created_at->format('Y-m-d H:i') }}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                            <a href="{{ $opportunity->listing_url }}" target="_blank" class="text-blue-600 hover:text-blue-900">
                                                                <i class="fas fa-external-link-alt"></i> View
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="text-center py-8">
                                        <i class="fas fa-inbox text-4xl text-gray-300 mb-4"></i>
                                        <p class="text-gray-500">No recent opportunities found.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
        </div>
    </div>
</div>

<!-- Scraping Modal -->
<div id="scrapingModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Trigger Scraping Job</h3>
                <button type="button" class="text-gray-400 hover:text-gray-600" onclick="closeModal()">
                    <span class="sr-only">Close</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form id="scrapingForm">
                <div class="mb-4">
                    <label for="auction_site_id" class="block text-sm font-medium text-gray-700 mb-2">Auction Site</label>
                    <select id="auction_site_id" name="auction_site_id" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Select Auction Site</option>
                        <option value="1">Aucor</option>
                        <option value="2">Burchmores</option>
                        <option value="3">Other</option>
                    </select>
                </div>
            </form>
            <div class="flex justify-end space-x-3 mt-6">
                <button type="button" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400" onclick="closeModal()">Cancel</button>
                <button type="button" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600" onclick="submitScraping()">Start Scraping</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
<script>
function syncOpportunities() {
    const btn = event.target.closest('button');
    const originalText = btn.innerHTML;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Syncing...';
    btn.disabled = true;

    fetch('{{ route("api-integration.sync-opportunities") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Success: ' + data.message);
            setTimeout(() => location.reload(), 2000);
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        alert('An error occurred while syncing opportunities.');
        console.error('Error:', error);
    })
    .finally(() => {
        btn.innerHTML = originalText;
        btn.disabled = false;
    });
}

function triggerScraping() {
    document.getElementById('scrapingModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('scrapingModal').classList.add('hidden');
}

function submitScraping() {
    const form = document.getElementById('scrapingForm');
    const formData = new FormData(form);

    closeModal();

    fetch('{{ route("api-integration.trigger-scraping") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Show success message (you can use Alpine.js or a simple alert)
            alert('Success: ' + data.message);
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        alert('An error occurred while triggering scraping.');
        console.error('Error:', error);
    });
}
</script>
    @endpush
</x-app-layout>
