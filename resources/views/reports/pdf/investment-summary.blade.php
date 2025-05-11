@extends('reports.pdf.layouts.master')

@section('content')
<div class="section">
    <h2>Investment Summary</h2>

    <div class="summary-box">
        <div class="summary-item">
            <span class="summary-label">Total Cars:</span>
            <span>{{ $data['total_cars'] }}</span>
        </div>
        <div class="summary-item">
            <span class="summary-label">Sold Cars:</span>
            <span>{{ $data['sold_cars'] }}</span>
        </div>
        <div class="summary-item">
            <span class="summary-label">Unsold Cars:</span>
            <span>{{ $data['unsold_cars'] }}</span>
        </div>
        <div class="summary-item">
            <span class="summary-label">Total Investment:</span>
            <span class="currency">R {{ number_format($data['total_investment'], 2) }}</span>
        </div>
        <div class="summary-item">
            <span class="summary-label">Total Revenue (Sold Cars):</span>
            <span class="currency">R {{ number_format($data['total_revenue'], 2) }}</span>
        </div>
        <div class="summary-item">
            <span class="summary-label">Estimated Value (Unsold Cars):</span>
            <span class="currency">R {{ number_format($data['estimated_value'], 2) }}</span>
        </div>
        <div class="summary-item">
            <span class="summary-label">Potential Value (Revenue + Estimated):</span>
            <span class="currency">R {{ number_format($data['potential_value'], 2) }}</span>
        </div>
        <div class="summary-item">
            <span class="summary-label">Potential Profit:</span>
            <span class="currency @if($data['potential_profit'] >= 0) text-success @else text-danger @endif">
                R {{ number_format($data['potential_profit'], 2) }}
            </span>
        </div>
        <div class="summary-item">
            <span class="summary-label">ROI Percentage:</span>
            <span class="@if($data['roi_percentage'] >= 0) text-success @else text-danger @endif">
                {{ number_format($data['roi_percentage'], 2) }}%
            </span>
        </div>
    </div>
</div>

<div class="section">
    <h2>Investment Breakdown</h2>

    <div class="summary-box">
        <div class="summary-item">
            <span class="summary-label">Purchase Cost:</span>
            <span class="currency">R {{ number_format($data['investment_by_category']['purchase'], 2) }}</span>
        </div>
        <div class="summary-item">
            <span class="summary-label">Parts Cost:</span>
            <span class="currency">R {{ number_format($data['investment_by_category']['parts'], 2) }}</span>
        </div>
        <div class="summary-item">
            <span class="summary-label">Labor Cost:</span>
            <span class="currency">R {{ number_format($data['investment_by_category']['labor'], 2) }}</span>
        </div>
        <div class="summary-item">
            <span class="summary-label">Painting Cost:</span>
            <span class="currency">R {{ number_format($data['investment_by_category']['painting'], 2) }}</span>
        </div>
    </div>
</div>

@if(isset($data['investment_by_make']) && count($data['investment_by_make']) > 0)
<div class="section">
    <h2>Investment by Make</h2>

    <table class="data-table">
        <thead>
            <tr>
                <th>Make</th>
                <th>Count</th>
                <th>Total Investment</th>
                <th>Avg. Investment</th>
                <th>Potential Value</th>
                <th>Potential Profit</th>
                <th>ROI</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['investment_by_make'] as $make => $makeData)
            <tr>
                <td>{{ $make }}</td>
                <td>{{ $makeData['count'] }} ({{ $makeData['sold_count'] }} sold)</td>
                <td class="currency">R {{ number_format($makeData['total_investment'], 2) }}</td>
                <td class="currency">R {{ number_format($makeData['avg_investment'], 2) }}</td>
                <td class="currency">R {{ number_format($makeData['potential_value'], 2) }}</td>
                <td class="currency @if($makeData['potential_profit'] >= 0) text-success @else text-danger @endif">
                    R {{ number_format($makeData['potential_profit'], 2) }}
                </td>
                <td class="@if($makeData['roi_percentage'] >= 0) text-success @else text-danger @endif">
                    {{ number_format($makeData['roi_percentage'], 2) }}%
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

@if(isset($data['monthly_trends']) && count($data['monthly_trends']) > 0)
<div class="section">
    <h2>Monthly Investment and Revenue Trends</h2>

    <table class="data-table">
        <thead>
            <tr>
                <th>Month</th>
                <th>Cars Purchased</th>
                <th>Cars Sold</th>
                <th>Investment</th>
                <th>Revenue</th>
                <th>Net Cash Flow</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['monthly_trends'] as $month)
            <tr>
                <td>{{ $month['month_name'] }}</td>
                <td>{{ $month['cars_purchased'] }}</td>
                <td>{{ $month['cars_sold'] }}</td>
                <td class="currency">R {{ number_format($month['investment'], 2) }}</td>
                <td class="currency">R {{ number_format($month['revenue'], 2) }}</td>
                <td class="currency @if($month['net_flow'] >= 0) text-success @else text-danger @endif">
                    R {{ number_format($month['net_flow'], 2) }}
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
                <th>Status</th>
                <th>Days Owned</th>
                <th>Purchase Price</th>
                <th>Repair Cost</th>
                <th>Total Investment</th>
                <th>Value</th>
                <th>Profit/Loss</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['cars'] as $car)
            <tr>
                <td>{{ $car['year'] }} {{ $car['make'] }} {{ $car['model'] }}</td>
                <td>{{ $car['status'] }}</td>
                <td>{{ $car['days_owned'] }}</td>
                <td class="currency">R {{ number_format($car['purchase_price'], 2) }}</td>
                <td class="currency">R {{ number_format($car['repair_cost'], 2) }}</td>
                <td class="currency">R {{ number_format($car['total_investment'], 2) }}</td>
                <td class="currency">R {{ number_format($car['value'], 2) }}</td>
                <td class="currency @if($car['profit'] >= 0) text-success @else text-danger @endif">
                    R {{ number_format($car['profit'], 2) }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
@endsection
