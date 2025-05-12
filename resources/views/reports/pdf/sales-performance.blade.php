@extends('reports.pdf.layouts.master')

@section('content')
<div class="section">
    <h2>Sales Performance Summary</h2>
    
    <div class="summary-box">
        <div class="summary-item">
            <span class="summary-label">Total Cars Sold:</span>
            <span>{{ $data['total_cars_sold'] }}</span>
        </div>
        <div class="summary-item">
            <span class="summary-label">Total Revenue:</span>
            <span class="currency">R {{ number_format($data['total_revenue'], 2) }}</span>
        </div>
        <div class="summary-item">
            <span class="summary-label">Average Selling Price:</span>
            <span class="currency">R {{ number_format($data['avg_selling_price'], 2) }}</span>
        </div>
        <div class="summary-item">
            <span class="summary-label">Average Time to Sell:</span>
            <span>{{ number_format($data['avg_time_to_sell'], 1) }} days</span>
        </div>
    </div>
</div>

@if(isset($data['by_month']) && count($data['by_month']) > 0)
<div class="section">
    <h2>Monthly Sales Trends</h2>
    
    <table class="data-table">
        <thead>
            <tr>
                <th>Month</th>
                <th>Cars Sold</th>
                <th>Total Revenue</th>
                <th>Avg. Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['by_month'] as $month => $monthData)
            <tr>
                <td>{{ $month }}</td>
                <td>{{ $monthData['count'] }}</td>
                <td class="currency">R {{ number_format($monthData['total_revenue'], 2) }}</td>
                <td class="currency">R {{ number_format($monthData['avg_price'], 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

@if(isset($data['by_make']) && count($data['by_make']) > 0)
<div class="section">
    <h2>Sales by Make</h2>
    
    <table class="data-table">
        <thead>
            <tr>
                <th>Make</th>
                <th>Cars Sold</th>
                <th>Total Revenue</th>
                <th>Avg. Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['by_make'] as $make => $makeData)
            <tr>
                <td>{{ $make }}</td>
                <td>{{ $makeData['count'] }}</td>
                <td class="currency">R {{ number_format($makeData['total_revenue'], 2) }}</td>
                <td class="currency">R {{ number_format($makeData['avg_price'], 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

@if(isset($data['cars']) && count($data['cars']) > 0)
<div class="section">
    <h2>Recent Sales</h2>
    
    <table class="data-table">
        <thead>
            <tr>
                <th>Car</th>
                <th>Sale Date</th>
                <th>Asking Price</th>
                <th>Selling Price</th>
                <th>Days at Dealership</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['cars'] as $car)
            <tr>
                <td>{{ $car['year'] }} {{ $car['make'] }} {{ $car['model'] }}</td>
                <td>{{ \Carbon\Carbon::parse($car['sale_date'])->format('M d, Y') }}</td>
                <td class="currency">R {{ number_format($car['asking_price'], 2) }}</td>
                <td class="currency">R {{ number_format($car['selling_price'], 2) }}</td>
                <td>{{ $car['days_at_dealership'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
@endsection
