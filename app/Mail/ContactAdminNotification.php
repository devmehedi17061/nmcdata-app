<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactAdminNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public array $contactData)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Contact Inquiry: ' . $this->contactData['subject'],
            replyTo: [
                new Address($this->contactData['email'], $this->contactData['full_name']),
            ],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact.admin',
            with: [
                'contactData' => $this->contactData,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
