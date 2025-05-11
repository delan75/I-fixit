@extends('reports.pdf.layouts.master')

@section('content')
<div class="section">
    <h2>Profitability Summary</h2>
    
    <div class="summary-box">
        <div class="summary-item">
            <span class="summary-label">Total Cars Sold:</span>
            <span>{{ $data['total_cars'] }}</span>
        </div>
        <div class="summary-item">
            <span class="summary-label">Total Revenue:</span>
            <span class="currency">R {{ number_format($data['total_revenue'], 2) }}</span>
        </div>
        <div class="summary-item">
            <span class="summary-label">Total Investment:</span>
            <span class="currency">R {{ number_format($data['total_investment'], 2) }}</span>
        </div>
        <div class="summary-item">
            <span class="summary-label">Total Profit:</span>
            <span class="currency @if($data['total_profit'] >= 0) text-success @else text-danger @endif">
                R {{ number_format($data['total_profit'], 2) }}
            </span>
        </div>
        <div class="summary-item">
            <span class="summary-label">Average Profit per Car:</span>
            <span class="currency @if($data['avg_profit'] >= 0) text-success @else text-danger @endif">
                R {{ number_format($data['avg_profit'], 2) }}
            </span>
        </div>
        <div class="summary-item">
            <span class="summary-label">Average ROI:</span>
            <span class="@if($data['avg_roi'] >= 0) text-success @else text-danger @endif">
                {{ number_format($data['avg_roi'], 2) }}%
            </span>
        </div>
    </div>
</div>

@if(isset($data['by_make']) && count($data['by_make']) > 0)
<div class="section">
    <h2>Profitability by Make</h2>
    
    <table class="data-table">
        <thead>
            <tr>
                <th>Make</th>
                <th>Count</th>
                <th>Total Profit</th>
                <th>Avg. Profit</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['by_make'] as $make => $makeData)
            <tr>
                <td>{{ $make }}</td>
                <td>{{ $makeData['count'] }}</td>
                <td class="currency @if($makeData['total_profit'] >= 0) text-success @else text-danger @endif">
                    R {{ number_format($makeData['total_profit'], 2) }}
                </td>
                <td class="currency @if($makeData['avg_profit'] >= 0) text-success @else text-danger @endif">
                    R {{ number_format($makeData['avg_profit'], 2) }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

@if(isset($data['by_month']) && count($data['by_month']) > 0)
<div class="section">
    <h2>Monthly Profit Trends</h2>
    
    <table class="data-table">
        <thead>
            <tr>
                <th>Month</th>
                <th>Cars Sold</th>
                <th>Total Revenue</th>
                <th>Total Profit</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['by_month'] as $month => $monthData)
            <tr>
                <td>{{ $month }}</td>
                <td>{{ $monthData['count'] }}</td>
                <td class="currency">R {{ number_format($monthData['revenue'], 2) }}</td>
                <td class="currency @if($monthData['profit'] >= 0) text-success @else text-danger @endif">
                    R {{ number_format($monthData['profit'], 2) }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

@if(isset($data['cars']) && count($data['cars']) > 0)
<div class="section">
    <h2>Car Details</h2>
    
    <table class="data-table">
        <thead>
            <tr>
                <th>Car</th>
                <th>Purchase Price</th>
                <th>Repair Cost</th>
                <th>Selling Price</th>
                <th>Profit</th>
                <th>ROI</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['cars'] as $car)
            <tr>
                <td>{{ $car['year'] }} {{ $car['make'] }} {{ $car['model'] }}</td>
                <td class="currency">R {{ number_format($car['purchase_price'], 2) }}</td>
                <td class="currency">R {{ number_format($car['repair_cost'], 2) }}</td>
                <td class="currency">R {{ number_format($car['selling_price'], 2) }}</td>
                <td class="currency @if($car['profit'] >= 0) text-success @else text-danger @endif">
                    R {{ number_format($car['profit'], 2) }}
                </td>
                <td class="@if($car['roi'] >= 0) text-success @else text-danger @endif">
                    {{ number_format($car['roi'], 2) }}%
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
@endsection
