<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProductBought extends Notification
{
    use Queueable;
    public $auction;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($auction)
    {
        $this->auction = $auction;
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
                    ->line('The auction for the product '.$this->auction->product->name.' has been closed.')
                    ->line('You have won the auction for the product '.$this->auction->product->name.' for Rs.'.$this->auction->winning_bid->amount)
                    ->action('Go To Product', url('/products/'.$this->auction->product->slug))
                    ->line('Thank you for using '.config('app.name'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
