<?php

namespace App\Http\Controllers;

use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestNotificationController extends Controller
{
    /**
     * The notification service instance.
     *
     * @var \App\Services\NotificationService
     */
    protected $notificationService;
    
    /**
     * Create a new controller instance.
     *
     * @param \App\Services\NotificationService $notificationService
     * @return void
     */
    public function __construct(NotificationService $notificationService)
    {
        $this->middleware('auth');
        $this->notificationService = $notificationService;
    }
    
    /**
     * Send a test notification to the current user.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendTestNotification()
    {
        $this->notificationService->createForCurrentUser(
            'test',
            'Test Notification',
            'This is a test notification to verify the real-time notification system.',
            null,
            'fa-bell',
            route('dashboard')
        );
        
        return redirect()->back()->with('success', 'Test notification sent successfully!');
    }
}
