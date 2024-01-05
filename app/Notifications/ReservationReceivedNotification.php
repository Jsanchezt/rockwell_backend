<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ReservationReceivedNotification extends Notification
{
    use Queueable;

    public $service, $staff, $date, $selectTime, $name, $email, $phone, $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($service, $staff, $date, $selectTime, $name, $email, $phone, $message)
    {
        $this->service = $service;
        $this->staff = $staff;
        $this->date = $date;
        $this->selectTime = $selectTime;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->message = $message;
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
            ->subject('Confirmación de Reservación')
            ->greeting('Hola ' . $this->name)
            ->line('Hemos recibido tu reservación con los siguientes detalles:')
            ->line('Servicio: ' . $this->service)
            ->line('Personal: ' . $this->staff)
            ->line('Fecha: ' . $this->date)
            ->line('Hora: ' . $this->selectTime)
            ->line('Mensaje: ' . $this->message)
            ->success()
            ->salutation('Gracias por elegirnos')
            ->salutation('rockwell.com.mx');
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
            'service' => $this->service,
            'staff' => $this->staff,
            'date' => $this->date,
            'selectTime' => $this->selectTime,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'message' => $this->message,
        ];
    }
}
