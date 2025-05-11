@extends('reports.pdf.layouts.master')

@section('content')
<div class="section">
    <h2>Repair Cost Summary</h2>

    <div class="summary-box">
        <div class="summary-item">
            <span class="summary-label">Total Cars:</span>
            <span>{{ $data['total_cars'] }}</span>
        </div>
        <div class="summary-item">
            <span class="summary-label">Total Repair Cost:</span>
            <span class="currency">R {{ number_format($data['cost_by_category']['parts'] + $data['cost_by_category']['labor'] + $data['cost_by_category']['painting'], 2) }}</span>
        </div>
        <div class="summary-item">
            <span class="summary-label">Average Repair Cost per Car:</span>
            <span class="currency">R {{ number_format($data['avg_repair_cost'], 2) }}</span>
        </div>
    </div>
</div>

<div class="section">
    <h2>Repair Cost Breakdown</h2>

    <div class="summary-box">
        <div class="summary-item">
            <span class="summary-label">Parts Cost:</span>
            <span class="currency">R {{ number_format($data['cost_by_category']['parts'], 2) }}</span>
        </div>
        <div class="summary-item">
            <span class="summary-label">Labor Cost:</span>
            <span class="currency">R {{ number_format($data['cost_by_category']['labor'], 2) }}</span>
        </div>
        <div class="summary-item">
            <span class="summary-label">Painting Cost:</span>
            <span class="currency">R {{ number_format($data['cost_by_category']['painting'], 2) }}</span>
        </div>
    </div>
</div>

<div class="section">
    <h2>Estimated vs. Actual Repair Costs</h2>

    <div class="summary-box">
        <div class="summary-item">
            <span class="summary-label">Estimated Repair Cost:</span>
            <span class="currency">R {{ number_format($data['estimated_vs_actual']['estimated'], 2) }}</span>
        </div>
        <div class="summary-item">
            <span class="summary-label">Actual Repair Cost:</span>
            <span class="currency">R {{ number_format($data['estimated_vs_actual']['actual'], 2) }}</span>
        </div>
        <div class="summary-item">
            <span class="summary-label">Difference:</span>
            <span class="currency @if($data['estimated_vs_actual']['difference'] <= 0) text-success @else text-danger @endif">
                R {{ number_format($data['estimated_vs_actual']['difference'], 2) }}
            </span>
        </div>
        <div class="summary-item">
            <span class="summary-label">Percentage Difference:</span>
            <span class="@if($data['estimated_vs_actual']['percentage_difference'] <= 0) text-success @else text-danger @endif">
                {{ number_format($data['estimated_vs_actual']['percentage_difference'], 2) }}%
            </span>
        </div>
    </div>
</div>

@if(isset($data['common_damaged_parts']) && count($data['common_damaged_parts']) > 0)
<div class="section">
    <h2>Common Damaged Parts</h2>

    <table class="data-table">
        <thead>
            <tr>
                <th>Part Name</th>
                <th>Count</th>
                <th>Avg. Repair Cost</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['common_damaged_parts'] as $part)
            <tr>
                <td>{{ $part['part_name'] }}</td>
                <td>{{ $part['count'] }}</td>
                <td class="currency">R {{ number_format($part['avg_cost'], 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

{{-- This section is commented out until repair_cost_by_make data is available
@if(isset($data['repair_cost_by_make']) && count($data['repair_cost_by_make']) > 0)
<div class="section">
    <h2>Repair Cost by Make</h2>

    <table class="data-table">
        <thead>
            <tr>
                <th>Make</th>
                <th>Count</th>
                <th>Avg. Repair Cost</th>
                <th>Avg. Parts Cost</th>
                <th>Avg. Labor Cost</th>
                <th>Avg. Painting Cost</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['repair_cost_by_make'] as $make => $makeData)
            <tr>
                <td>{{ $make }}</td>
                <td>{{ $makeData['count'] }}</td>
                <td class="currency">R {{ number_format($makeData['avg_repair_cost'], 2) }}</td>
                <td class="currency">R {{ number_format($makeData['avg_parts_cost'], 2) }}</td>
                <td class="currency">R {{ number_format($makeData['avg_labor_cost'], 2) }}</td>
                <td class="currency">R {{ number_format($makeData['avg_painting_cost'], 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
--}}
@endsection
