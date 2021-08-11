<?php

namespace App\Notifications;

use App\Models\Content;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewContentNotification extends Notification
{
    use Queueable;
protected Content $content;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Content $content)
    {
        $this->content=$content;

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
        return (new MailMessage)
        ->greeting('Hello'.$notifiable->name)
        ->subject(' New content')
                    ->line('A new content has been created ')
                    ->action('view content', url('/'))
                    ->line('Thank you for using our application!');
    }
    public function toDataBase($notifiable)
    {
return[
'title'=>'New content',
'body'=>'A new content has been created by ',
'action'=>url('/admin/content/show/'.$this->content->id),
'auther'=>$this->content->user->name,
'category'=>$this->content->category->title
];
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
