<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ConfirmSaleNotification extends Notification
{
    use Queueable;

    public $nameUser;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($nameUser)
    {
        $this->nameUser = $nameUser;
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
                    ->greeting('Hola '+ $this->nameUser)
                    ->line('Gracias por tu compra')
                    ->line('Tu compra fue confirmada, en un momento te vamos a contactar para verificar tu metodo de pago')
                    ->action('Ver detalle', url('https://www.rockwell.com.mx/dashboard'))
                    ->line('Cualquier duda podrias contactarnos en contacto@rockwell.com.mx');
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
