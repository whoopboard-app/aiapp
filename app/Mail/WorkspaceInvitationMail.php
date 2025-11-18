<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Modules\Settings\Models\WorkspaceInvitation;

class WorkspaceInvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $invitation;
    public $invitationUrl;

    /**
     * Create a new message instance.
     */
    public function __construct(WorkspaceInvitation $invitation)
    {
        $this->invitation = $invitation;
        $this->invitationUrl = route('invite.signup', ['token' => $invitation->token]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'You\'ve been invited to join ' . $this->invitation->workspace->name,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.workspace-invitation',
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
