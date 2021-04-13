<?php

namespace App\Notifications;

use CoinbaseCommerce\Resources\Charge;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\HtmlString;

class CoinbaseChargeCompleted extends Notification
{
    private $charge;

    /**
     * Create a new notification instance.
     *
     * @param Charge $charge
     */
    public function __construct(Charge $charge)
    {
        $this->charge = $charge;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Payment status updated #'.$this->charge['code'])
                    ->line(new HtmlString('The crypto payment with code <strong>'.$this->charge['code'].'</strong> has been successfully processed.'))
                    ->line('The purchased subscription has been added to your account.')
                    ->action('View profile', route('profile'))
                    ->line(new HtmlString('You are now subscribed until <strong>'.$notifiable->subscribed_to->format('d/m/Y').'</strong>.'));
    }
}
