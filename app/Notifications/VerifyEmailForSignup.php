<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Modules\Auth\Models\PendingRegistration;

class VerifyEmailForSignup extends Notification
{
    use Queueable;

    protected $pendingRegistration;

    /**
     * Create a new notification instance.
     */
    public function __construct(PendingRegistration $pendingRegistration)
    {
        $this->pendingRegistration = $pendingRegistration;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $verificationUrl = route('signup.verify', ['token' => $this->pendingRegistration->token]);

        return (new MailMessage)
            ->subject('Verify your email to join InsightHQ')
            ->greeting('Welcome to InsightHQ!')
            ->line('Thank you for signing up. Please verify your email address to continue setting up your account.')
            ->action('Verify Email Address', $verificationUrl)
            ->line('This link will expire in 24 hours.')
            ->line('If you did not create an account, no further action is required.')
            ->salutation('Best regards, The InsightHQ Team');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
