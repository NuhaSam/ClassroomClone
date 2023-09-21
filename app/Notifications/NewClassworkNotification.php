<?php

namespace App\Notifications;

use App\Models\Classwork;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\VonageMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewClassworkNotification extends Notification
{

    protected Classwork $classwork;

    public function __construct(Classwork $classwork)
    {
        $this->classwork = $classwork;  
    }
  
    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable): array
    {
        return ['database', 'broadcast', 'mail'
       //         ,'vonage',
                    ];
    }

    // public function toVonage() :VonageMessage
    // {
    //     return (new VonageMessage)->content("N");
    // }
    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $classwork = $this->classwork;
        $content =  __(':name posted a new :type : :title', [
            'name' => $classwork->user->name,
            'type' => __($classwork->type),
            'title' => $classwork->title,
        ]);
        return (new MailMessage)
            ->subject(__('New :type', [
                'type' => $classwork->type,
            ]))->greeting(__('Hi :name', [
                'name' =>  $notifiable->name,
            ]))
            ->line($content)
            ->action('Go Classwork', route('classroom.classworks.show', [$classwork->classroom_id, $classwork->id]))
            ->line('Thank you for using our application!');
    }
    /**
     * Get the database representation of the notification.
     */
    public function toDatabase(object $notifiable): DatabaseMessage
    {
        return new DatabaseMessage($this->createMessage());
    }
    /**
     * Get the mail representation of the notification.
     */
    public function toBroadcast(object $notifiable): BroadcastMessage
    {
            return new BroadcastMessage($this->createMessage());
    }

    protected function createMessage() :array
    {
        $classwork = $this->classwork;
        $content =  __(':name posted a new :type : :title', [
            'name' => $classwork->user->name,
            'type' => __($classwork->type),
            'title' => $classwork->title,
        ]);
        return [
            'title' => __('new  :type',[
                'type' => $classwork->type,
            ]),
            'body' => $content,
            'image' => '',
            'link' => route('classroom.classworks.show', [$classwork->classroom_id, $classwork->id]),
            'classwork_id' => $classwork->id,
        ];

    }
    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
