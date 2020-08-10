<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomerFeedback extends Notification
{
    use Queueable;

    protected $data;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
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
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'id'                    => $this->data->id,
            'name'                  => $this->data->name,
            'phone'                 => $this->data->phone_no,
            'email'                 => $this->data->email,
            'daruuri_rating'        => $this->data->daruuri_rating,
            'communication_rating'  => $this->data->communication_rating,
            'stuff_rating'          => $this->data->stuff_rating,
            'service_rating'        => $this->data->service_rating,
            'referal_rating'        => $this->data->referal_rating,
            'description'           => $this->data->description,
        ];
    }
}
