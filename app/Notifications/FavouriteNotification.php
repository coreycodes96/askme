<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FavouriteNotification extends Notification
{
    use Queueable;

    protected $favourite; //favourite variable

    public function __construct($favourite)
    {
        $this->favourite = $favourite; //putting the favourite in a construct function
    }

    public function via($notifiable)
    {
        //put notification in the database and broadcast
        return ['database', 'broadcast'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'favourite' => $this->favourite, //the users favourite
            'user' => $notifiable //the users information
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'favourite' => $this->favourite, //the users favourite
            'user' => $notifiable //the users information
        ]);
    }
}
