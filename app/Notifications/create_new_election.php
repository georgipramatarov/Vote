<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class create_new_election extends Notification
{
    use Queueable;
    protected $elec;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
     //here $electCreate is $electioncreate
     //new create_new_election($electioncreate)
    public function __construct($electCreate)
    {
        $this->elec=$electCreate;
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
                    ->greeting('Hello Admins!')
                    ->line('New Election has been created.')
                    ->action('OK', 'http://127.0.0.1:8000/admin_home/create_election')
                    ->line('Thank you!');
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
