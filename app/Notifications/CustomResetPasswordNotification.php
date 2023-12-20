<?php
namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;

class CustomResetPasswordNotification extends ResetPasswordNotification
{
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Hola, has solicitado restablecer tu contraseña.')
            ->action('Restablecer Contraseña', url('password/reset', $this->token))
            ->line('Si no solicitaste esto, puedes ignorar este correo.');
    }
}
