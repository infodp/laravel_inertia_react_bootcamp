<?php

namespace App\Listeners;

use App\Events\PostCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Models\User;
use App\Notifications\NewPost;

class SendPostCreatedNotifications implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\PostCreated  $event
     * @return void
     */
    public function handle(PostCreated $event)
    {
        foreach(User::whereNot('id', $event->post->user_id)->cursor() as $user)
        {
            $user->notify(new NewPost($event->post));
        }
    }
}
