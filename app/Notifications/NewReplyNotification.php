<?php

namespace App\Notifications;

use App\Http\Resources\ReplyResource;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Reply as ModelsReply;
use Illuminate\Notifications\Messages\BroadcastMessage;

class NewReplyNotification extends Notification
{
    use Queueable;

    public $reply;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(ModelsReply $reply)
    {
        $this->reply = $reply;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','broadcast'];
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
            "reply_by" => $this->reply->user->name, // this is reply user
            "question" => $this->reply->question->title,
            "path" => $this->reply->question->path,
        ];
    }

    public function toBroadcast($notifiable)
{
    return new BroadcastMessage([
        "reply_by" => $this->reply->user->name, // this is reply user
        "question" => $this->reply->question->title,
        "path" => $this->reply->question->path,
        "reply" => new ReplyResource($this->reply),
    ]);
}
}
