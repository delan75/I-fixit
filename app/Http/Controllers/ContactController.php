<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    /**
     * Display the contact form.
     */
    public function index()
    {
        return view('contact.index');
    }

    /**
     * Store a new contact message.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'message' => 'required|string',
        ]);

        // Create the contact message
        $contact = Contact::create($validated);

        // Send email notification to admin
        try {
            $adminEmail = config('mail.admin_email', config('mail.from.address'));

            Mail::send('emails.contact', ['contact' => $contact], function ($message) use ($contact, $adminEmail) {
                $message->to($adminEmail)
                    ->subject('New Contact Form Submission');

                // If the user provided an email, set it as the reply-to address
                if ($contact->email) {
                    $message->replyTo($contact->email, $contact->name ?? 'Contact Form User');
                }
            });
        } catch (\Exception $e) {
            Log::error('Failed to send contact form email: ' . $e->getMessage());
            // Continue execution even if email fails
        }

        return redirect()->route('contact.index')
            ->with('success', 'Your message has been sent successfully. We will get back to you soon!');
    }

    /**
     * Display a listing of contact messages (admin only).
     */
    public function adminIndex()
    {
        // Get all contact messages, newest first
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(10);

        return view('contact.admin.index', compact('contacts'));
    }

    /**
     * Display the specified contact message (admin only).
     */
    public function adminShow(Contact $contact)
    {
        // Mark the message as read if it's not already
        if (!$contact->is_read) {
            $contact->is_read = true;
            $contact->save();
        }

        return view('contact.admin.show', compact('contact'));
    }

    /**
     * Delete the specified contact message (admin only).
     */
    public function adminDestroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('contact.admin.index')
            ->with('success', 'Contact message deleted successfully.');
    }
}
