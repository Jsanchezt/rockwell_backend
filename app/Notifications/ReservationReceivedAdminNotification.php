<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ReservationReceivedAdminNotification extends Notification
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
            ->greeting('Hola Rockwell')
            ->line('Hemos recibido una reservación con los siguientes detalles:')
            ->line('Nombre: ' . $this->name)
            ->line('Servicio: ' . $this->service)
            ->line('Personal: ' . $this->staff)
            ->line('Fecha: ' . $this->date)
            ->line('Hora: ' . $this->selectTime)
            ->line('Mensaje: ' . $this->message)
            ->action('Confirmar', url($this->sendMessageActive($this->name, $this->phone, $this->date, $this->selectTime, $this->service)))
            ->success()
            ->salutation('Gracias por elegirnos')
            ->salutation('rockwell.com.mx');
    }

    function sendMessageActive($name,$phone,$date, $select_time,$service) {
        $baseLink = "https://wa.me/+52" . $phone;
        $message = "¡Hola {$name}, soy Samuel del equipo de *Rockwell*\n";
        $message .= "Te contacto porque hemos recibido tu reservación el *$date* a las *$select_time*\n";
        $message .= "Para los servicios de : *$service*\n";
        $message .= "¿Podrías confirmar tu asistencia, por favor?\n";

        $encodedMessage = urlencode($message);
        $whatsappLink = $baseLink . "?text=" . $encodedMessage;

        return $whatsappLink;
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
