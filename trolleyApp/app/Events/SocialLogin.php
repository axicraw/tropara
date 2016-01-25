<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SocialLogin extends Event
{
    use SerializesModels;

    public $user_cred;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user_cred)
    {
        //
        $this->user_cred = $user_cred;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
