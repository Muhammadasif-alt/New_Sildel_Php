<?php

namespace App\Mail;

use App\Models\Enquiry;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

/**
 * Notifies the atelier of a new website enquiry. Sent synchronously
 * (shared hosting has no queue worker). Replying answers the client directly.
 */
class EnquiryReceived extends Mailable
{
    public function __construct(public Enquiry $enquiry) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            replyTo: [new Address($this->enquiry->email, $this->enquiry->name)],
            subject: __('forms.mail.subject', ['name' => $this->enquiry->name]),
        );
    }

    public function content(): Content
    {
        return new Content(view: 'mail.enquiry-received');
    }
}
