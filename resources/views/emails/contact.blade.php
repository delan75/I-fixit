<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Contact Form Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
            padding: 20px;
        }
        h1 {
            color: #4CAF50;
            margin-top: 0;
        }
        .message-box {
            background-color: #fff;
            border: 1px solid #eee;
            border-radius: 5px;
            padding: 15px;
            margin-top: 20px;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #777;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>New Contact Form Submission</h1>
        <p>You have received a new message from the contact form on your website.</p>
        
        <div class="message-box">
            <p><strong>Name:</strong> {{ $contact->name ?? 'Not provided' }}</p>
            <p><strong>Email:</strong> {{ $contact->email ?? 'Not provided' }}</p>
            <p><strong>Message:</strong></p>
            <p>{{ $contact->message }}</p>
            <p><strong>Submitted at:</strong> {{ $contact->created_at->format('F j, Y, g:i a') }}</p>
        </div>
        
        <div class="footer">
            <p>This is an automated email from your website's contact form.</p>
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
