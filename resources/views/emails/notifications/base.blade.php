<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title ?? 'I-fixit Notification' }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            padding: 20px;
            margin: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
            padding: 20px;
        }
        .header {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            border-radius: 5px 5px 0 0;
            margin: -20px -20px 20px -20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            background-color: #fff;
            border: 1px solid #eee;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #777;
            text-align: center;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }
        .button {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 15px;
        }
        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ $title ?? 'I-fixit Notification' }}</h1>
        </div>
        
        <div class="content">
            @yield('content')
            
            @if(isset($actionUrl) && isset($actionText))
            <div style="text-align: center; margin-top: 20px;">
                <a href="{{ $actionUrl }}" class="button">{{ $actionText }}</a>
            </div>
            @endif
        </div>
        
        <div class="footer">
            <p>This is an automated notification from I-fixit.</p>
            <p>If you prefer not to receive these notifications, you can update your <a href="{{ route('preferences.edit') }}">notification preferences</a>.</p>
            <p>&copy; {{ date('Y') }} I-fixit. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
