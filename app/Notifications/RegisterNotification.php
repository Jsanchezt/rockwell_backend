<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RegisterNotification extends Notification
{
    use Queueable;

    public $nameUser;
    public $products;
    public $total;

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
        $mtp =  (new MailMessage)
                    ->success()
                    ->greeting('Hola '. $this->nameUser)
                    ->line('Gracias por tu registrarte en Rockwell')
                    ->line('Esperamos que puedas encontrar los mejores que productos que tenemos para ti');

        $mtp->line('Cualquier duda podrias contactarnos en contacto@rockwell.com.mx');
        $mtp->salutation("rockwell.com.mx");


        return $mtp;
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
