<?php

namespace App\Notifications;

use CoinbaseCommerce\Resources\Charge;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\HtmlString;

class CoinbaseChargeFailed extends Notification
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
                    ->subject('Payment status updated')
                    ->line(new HtmlString('The crypto payment with code <strong>'.$this->charge['code'].'</strong> has failed.'))
                    ->line('This can happen due to underpayment or overpayment.')
                    ->line('The balance will be refunded to your cryptocurrency wallet. If you would like, you can create a new charge and try again.')
                    ->action('Retry payment', route('subscribe.coinbase'));
    }
}
