@extends('emails.notifications.base')

@section('content')
    <p>Hello {{ $user->first_name }},</p>
    
    <p>This is to inform you that the following car has been in the repair phase for {{ $days }} days:</p>
    
    <div style="margin: 15px 0; padding: 10px; background-color: #f5f5f5; border-left: 4px solid #4CAF50;">
        <p><strong>Car:</strong> {{ $car->year }} {{ $car->make }} {{ $car->model }}</p>
        <p><strong>VIN:</strong> {{ $car->vin }}</p>
        <p><strong>Days in repair:</strong> {{ $days }}</p>
        <p><strong>Current repair costs:</strong> R{{ number_format($car->total_repair_cost, 2) }}</p>
    </div>
    
    <p>You may want to check on the progress of repairs and ensure everything is on track.</p>
    
    <p>Thank you,<br>I-fixit Team</p>
@endsection
