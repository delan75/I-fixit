@extends('emails.notifications.base')

@section('content')
    <p>Hello {{ $user->first_name }},</p>
    
    <p>This is to inform you that the following car has been at the dealership for {{ $days }} days:</p>
    
    <div style="margin: 15px 0; padding: 10px; background-color: #f5f5f5; border-left: 4px solid #4CAF50;">
        <p><strong>Car:</strong> {{ $car->year }} {{ $car->make }} {{ $car->model }}</p>
        <p><strong>VIN:</strong> {{ $car->vin }}</p>
        <p><strong>Days at dealership:</strong> {{ $days }}</p>
        <p><strong>Estimated market value:</strong> R{{ number_format($car->estimated_market_value, 2) }}</p>
        <p><strong>Total investment:</strong> R{{ number_format($car->total_investment, 2) }}</p>
    </div>
    
    <p>You may want to review the pricing strategy or consider other marketing approaches to expedite the sale.</p>
    
    <p>Thank you,<br>I-fixit Team</p>
@endsection
