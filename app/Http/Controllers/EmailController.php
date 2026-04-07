<?php

namespace App\Http\Controllers;

use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function index()
    {
        $emails = Email::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('email.index', compact('emails'));
    }

    public function compose()
    {
        return view('email.compose');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'sender_name' => 'required|string|max:255',
            'sender_email' => 'required|email|max:255',
            'recipient_email' => 'required|email|max:255',
            'cc' => 'nullable|string|max:500',
            'bcc' => 'nullable|string|max:500',
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $email = Email::create([
            'user_id' => Auth::id(),
            'sender_name' => $validated['sender_name'],
            'sender_email' => $validated['sender_email'],
            'recipient_email' => $validated['recipient_email'],
            'cc' => $validated['cc'],
            'bcc' => $validated['bcc'],
            'subject' => $validated['subject'],
            'description' => $validated['description'],
            'status' => 'pending',
        ]);

        try {
            $ccAddresses = !empty($validated['cc'])
                ? array_map('trim', explode(',', $validated['cc']))
                : [];
            $bccAddresses = !empty($validated['bcc'])
                ? array_map('trim', explode(',', $validated['bcc']))
                : [];

            Mail::raw($validated['description'], function ($message) use ($validated, $ccAddresses, $bccAddresses) {
                $message->from($validated['sender_email'], $validated['sender_name'])
                    ->to($validated['recipient_email'])
                    ->subject($validated['subject']);

                if (!empty($ccAddresses)) {
                    $message->cc($ccAddresses);
                }
                if (!empty($bccAddresses)) {
                    $message->bcc($bccAddresses);
                }
            });

            $email->update([
                'status' => 'sent',
                'sent_at' => now(),
            ]);

            return redirect()->route('email.index')
                ->with('success', 'Email sent successfully!');
        } catch (\Exception $e) {
            $email->update(['status' => 'failed']);

            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to send email: ' . $e->getMessage());
        }
    }

    public function show(Email $email)
    {
        if ($email->user_id !== Auth::id()) {
            abort(403);
        }

        return view('email.show', compact('email'));
    }

    public function destroy(Email $email)
    {
        if ($email->user_id !== Auth::id()) {
            abort(403);
        }

        $email->delete();

        return redirect()->route('email.index')
            ->with('success', 'Email deleted successfully.');
    }
}
