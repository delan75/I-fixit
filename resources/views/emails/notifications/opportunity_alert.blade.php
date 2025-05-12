@extends('emails.notifications.base')

@section('content')
    <p>Hello {{ $user->first_name }},</p>
    
    <p>We've identified a potential investment opportunity that matches your preferences:</p>
    
    <div style="margin: 15px 0; padding: 10px; background-color: #f5f5f5; border-left: 4px solid #3498db;">
        <p><strong>Car:</strong> {{ $opportunity->year }} {{ $opportunity->make }} {{ $opportunity->model }}</p>
        <p><strong>Auction:</strong> {{ $opportunity->auction_name }}</p>
        <p><strong>Estimated purchase price:</strong> R{{ number_format($opportunity->estimated_price, 2) }}</p>
        <p><strong>Estimated repair cost:</strong> R{{ number_format($opportunity->estimated_repair_cost, 2) }}</p>
        <p><strong>Estimated market value:</strong> R{{ number_format($opportunity->estimated_market_value, 2) }}</p>
        <p><strong>Potential profit:</strong> R{{ number_format($opportunity->potential_profit, 2) }}</p>
        <p><strong>Opportunity score:</strong> {{ $opportunity->score }}/100</p>
    </div>
    
    <p>This opportunity aligns with your investment preferences and has a high potential for profitability.</p>
    
    <p>Thank you,<br>I-fixit Team</p>
@endsection
