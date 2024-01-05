<?php

namespace App;
use Illuminate\Notifications\Notifiable;

class TemporalUser
{
    use Notifiable;

    public $email;

    public function __construct($email)
    {
        $this->email = $email;
    }

    public function routeNotificationForMail()
    {
        return $this->email;
    }
}
