<?php

namespace App\Mail;

use App\Models\GasRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class GasRequestStatusUpdated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $gasRequest;
    /**
     * Create a new message instance.
     */
    public function __construct(GasRequest $gasRequest)
    {
        $this->gasRequest = $gasRequest;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Gas Request Status Has Been Updated',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.gasRequestStatusUpdated',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
