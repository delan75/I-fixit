@extends('emails.notifications.base')

@section('content')
    <p>Hello {{ $user->first_name }},</p>
    
    <p>Your scheduled report "{{ $scheduledReport->name }}" has been generated.</p>
    
    <div style="margin: 15px 0; padding: 10px; background-color: #f5f5f5; border-left: 4px solid #4CAF50;">
        <p><strong>Report Type:</strong> {{ $report->reportType->name }}</p>
        <p><strong>Title:</strong> {{ $report->title }}</p>
        <p><strong>Generated At:</strong> {{ $report->generated_at->format('Y-m-d H:i:s') }}</p>
        
        @if(isset($report->filters['date_range']))
            <p><strong>Date Range:</strong> 
                @switch($report->filters['date_range'])
                    @case('last_30_days')
                        Last 30 Days
                        @break
                    @case('last_90_days')
                        Last 90 Days
                        @break
                    @case('last_6_months')
                        Last 6 Months
                        @break
                    @case('last_year')
                        Last Year
                        @break
                    @case('all_time')
                        All Time
                        @break
                    @case('custom')
                        {{ isset($report->filters['start_date']) ? \Carbon\Carbon::parse($report->filters['start_date'])->format('Y-m-d') : '' }} 
                        to 
                        {{ isset($report->filters['end_date']) ? \Carbon\Carbon::parse($report->filters['end_date'])->format('Y-m-d') : '' }}
                        @break
                    @default
                        {{ $report->filters['date_range'] }}
                @endswitch
            </p>
        @endif
        
        @if(isset($report->filters['make']) && $report->filters['make'])
            <p><strong>Make:</strong> {{ $report->filters['make'] }}</p>
        @endif
        
        @if(isset($report->filters['model']) && $report->filters['model'])
            <p><strong>Model:</strong> {{ $report->filters['model'] }}</p>
        @endif
        
        @if(isset($report->filters['year']) && $report->filters['year'])
            <p><strong>Year:</strong> {{ $report->filters['year'] }}</p>
        @endif
        
        @if(isset($report->filters['phase']) && $report->filters['phase'])
            <p><strong>Phase:</strong> {{ ucfirst($report->filters['phase']) }}</p>
        @endif
    </div>
    
    <p>The report has been attached to this email. You can also view it online by clicking the button below.</p>
    
    <p>This report will continue to be generated {{ $scheduledReport->frequency }} according to your schedule.</p>
    
    <p>Thank you,<br>I-fixit Team</p>
@endsection
