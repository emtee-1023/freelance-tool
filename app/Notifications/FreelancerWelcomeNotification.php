<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class FreelancerWelcomeNotification extends Notification
{
    use Queueable;

    protected $token;

    /**
     * Create a new notification instance.
     */
    public function __construct($token)
    {
        $this->token = $token;
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
        $resetUrl = URL::to('/freelancers/set-password?token=' . $this->token . '&email=' . $notifiable->email);

        return (new MailMessage)
            ->subject('WELCOME TO OUR PLATFORM')
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('You have been added as a freelancer on our platform.')
            ->line('You will need to reset your password to access your account.')
            ->action('Set Your Password', $resetUrl)
            ->line('Click the button above to set your password and activate your account.');
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
