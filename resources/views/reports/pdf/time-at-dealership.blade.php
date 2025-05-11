@extends('reports.pdf.layouts.master')

@section('content')
<div class="section">
    <h2>Time at Dealership Summary</h2>
    
    <div class="summary-box">
        <div class="summary-item">
            <span class="summary-label">Total Cars:</span>
            <span>{{ $data['total_cars'] }}</span>
        </div>
        <div class="summary-item">
            <span class="summary-label">Sold Cars:</span>
            <span>{{ $data['sold_count'] }}</span>
        </div>
        <div class="summary-item">
            <span class="summary-label">Unsold Cars:</span>
            <span>{{ $data['unsold_count'] }}</span>
        </div>
        <div class="summary-item">
            <span class="summary-label">Average Days at Dealership:</span>
            <span>{{ number_format($data['avg_days_at_dealership'], 1) }} days</span>
        </div>
    </div>
</div>

<div class="section">
    <h2>Days at Dealership Distribution</h2>
    
    <table class="data-table">
        <thead>
            <tr>
                <th>Days Range</th>
                <th>Number of Cars</th>
                <th>Percentage</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['day_ranges'] as $range => $count)
            <tr>
                <td>{{ $range }}</td>
                <td>{{ $count }}</td>
                <td>{{ number_format(($count / $data['total_cars']) * 100, 1) }}%</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@if(isset($data['cars']) && count($data['cars']) > 0)
<div class="section">
    <h2>Car Details</h2>
    
    <table class="data-table">
        <thead>
            <tr>
                <th>Car</th>
                <th>Days at Dealership</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['cars'] as $car)
            <tr>
                <td>{{ $car['year'] }} {{ $car['make'] }} {{ $car['model'] }}</td>
                <td>{{ $car['days_at_dealership'] }}</td>
                <td>{{ $car['is_sold'] ? 'Sold' : 'At Dealership' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
@endsection
