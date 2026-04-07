<?php

namespace App\Http\Controllers;

use App\Mail\ContactAdminNotification;
use App\Mail\ContactUserAcknowledgement;
use App\Models\Email;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $contactData = [
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'full_name' => trim($validated['first_name'] . ' ' . $validated['last_name']),
            'email' => $validated['email'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'submitted_at' => now()->toDateTimeString(),
        ];

        $emailLog = null;

        try {
            $adminRecipients = $this->resolveAdminRecipients();
            $ownerUser = $this->resolveOwnerUser($adminRecipients);

            $primaryRecipient = $adminRecipients[0] ?? config('mail.from.address');
            $ccRecipients = count($adminRecipients) > 1
                ? implode(',', array_slice($adminRecipients, 1))
                : null;

            $emailLog = Email::create([
                'user_id' => $ownerUser->id,
                'sender_name' => $contactData['full_name'],
                'sender_email' => $contactData['email'],
                'recipient_email' => $primaryRecipient,
                'cc' => $ccRecipients,
                'bcc' => null,
                'subject' => '[Contact Form] ' . $contactData['subject'],
                'description' => $contactData['message'],
                'status' => 'pending',
            ]);

            Mail::to($adminRecipients)->send(new ContactAdminNotification($contactData));
            Mail::to($contactData['email'])->send(new ContactUserAcknowledgement($contactData));

            $emailLog->update([
                'status' => 'sent',
                'sent_at' => now(),
            ]);

            return redirect()
                ->back()
                ->with('success', 'Your message has been sent successfully and saved in Email Management. A confirmation email has also been sent to your inbox.');
        } catch (\Throwable $exception) {
            report($exception);

            if ($emailLog) {
                $emailLog->update([
                    'status' => 'failed',
                ]);
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'We could not send your message right now. Please try again in a few minutes.');
        }
    }

    /**
     * Resolve contact recipients dynamically from config, admin users, then fallback sender.
     */
    private function resolveAdminRecipients(): array
    {
        $configuredEmails = array_values(array_filter((array) config('mail.contact_admin_emails', [])));

        if (!empty($configuredEmails)) {
            return $configuredEmails;
        }

        $adminUserEmails = User::query()
            ->whereNotNull('email')
            ->whereHas('role', function ($query) {
                $query->whereIn('name', ['Superadmin', 'Admin']);
            })
            ->pluck('email')
            ->unique()
            ->values()
            ->all();

        if (!empty($adminUserEmails)) {
            return $adminUserEmails;
        }

        return [config('mail.from.address')];
    }

    /**
     * Pick an owner user so contact emails are visible in Email Management.
     */
    private function resolveOwnerUser(array $adminRecipients): User
    {
        $recipientOwner = User::query()
            ->whereIn('email', $adminRecipients)
            ->whereHas('role', function ($query) {
                $query->whereIn('name', ['Superadmin', 'Admin']);
            })
            ->first();

        if ($recipientOwner) {
            return $recipientOwner;
        }

        $adminOwner = User::query()
            ->whereHas('role', function ($query) {
                $query->whereIn('name', ['Superadmin', 'Admin']);
            })
            ->first();

        if ($adminOwner) {
            return $adminOwner;
        }

        return User::query()->firstOrFail();
    }
}
