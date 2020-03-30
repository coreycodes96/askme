<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SubscribersNotification extends Notification
{
    use Queueable;

    protected $subscriber; //subscriber variable

    public function __construct($subscriber)
    {
        $this->subscriber = $subscriber; //putting the subscriber in a construct function
    }

    public function via($notifiable)
    {
        //put notification in the database and broadcast
        return ['database', 'broadcast'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'subscriber' => $this->subscriber, //the users subscriber
            'user' => $notifiable //the users information
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'subscriber' => $this->subscriber, //the users subscriber
            'user' => $notifiable //the users information
        ]);
    }
}
