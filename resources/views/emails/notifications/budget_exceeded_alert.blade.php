@extends('emails.notifications.base')

@section('content')
    <p>Hello {{ $user->first_name }},</p>
    
    <p>This is to inform you that the repair costs for the following car have exceeded the estimated budget:</p>
    
    <div style="margin: 15px 0; padding: 10px; background-color: #f5f5f5; border-left: 4px solid #e74c3c;">
        <p><strong>Car:</strong> {{ $car->year }} {{ $car->make }} {{ $car->model }}</p>
        <p><strong>VIN:</strong> {{ $car->vin }}</p>
        <p><strong>Estimated repair budget:</strong> R{{ number_format($car->estimated_repair_cost, 2) }}</p>
        <p><strong>Current repair costs:</strong> R{{ number_format($car->total_repair_cost, 2) }}</p>
        <p><strong>Exceeded by:</strong> {{ $percentage }}%</p>
    </div>
    
    <p>You may want to review the repair costs and make necessary adjustments to ensure profitability.</p>
    
    <p>Thank you,<br>I-fixit Team</p>
@endsection
