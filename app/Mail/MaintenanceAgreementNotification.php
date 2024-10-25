<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MaintenanceAgreementNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $agreement;
    public $type;

    /**
     * Create a new message instance.
     */
    public function __construct($agreement, $type)
    {
        $this->agreement = $agreement;
        $this->type = $type;
        
    }

    /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Maintenance Agreement Notification',
    //     );
    // }

    // /**
    //  * Get the message content definition.
    //  */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

    // /**
    //  * Get the attachments for the message.
    //  *
    //  * @return array<int, \Illuminate\Mail\Mailables\Attachment>
    //  */
    // public function attachments(): array
    // {
    //     return [];
    // }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject("Maintenance Agreement: {$this->type}")
                    ->view('emails.maintenanceAgreementNotification')
                    ->with([
                        'agreement' => $this->agreement,
                        'type' => $this->type,
                    ]);
    }
}
