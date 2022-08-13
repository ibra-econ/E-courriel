<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ImpuationNotification extends Notification
{
    use Queueable;

    public $courrier;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($courrier)
    {
        $this->courrier = $courrier;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // return (new MailMessage)
        //             ->line("Vous avez été imputer d'un nouveau courrier")
        //             ->line('Numero:'.$this->courrier->numero)
        //             ->line('Reference:'.$this->courrier->reference)
        //             ->line('Objet:'.$this->courrier->objet)
        //             ->line('Date arrivée:'.$this->courrier->date_arriver)
        //             ->line('Merci!');
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
            'title' =>"Vous avez été imputer courrier N°".$this->courrier->numero,
        ];
    }
}
