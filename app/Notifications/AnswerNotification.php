<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AnswerNotification extends Notification
{
    use Queueable;

    protected $answer; //answer variable

    public function __construct($answer)
    {
        $this->answer = $answer; //putting the answer in a construct function
    }

    public function via($notifiable)
    {
        //put notification in the database and broadcast
        return ['database', 'broadcast'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'answer' => $this->answer, //the users answer
            'user' => $notifiable //user information
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'answer' => $this->answer, //the users answer
            'user' => $notifiable //user information
        ]);
    }
}
