<?php

namespace App\Events;

use App\User;
use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class VoidSearch extends Event
{
    use SerializesModels;

    public $user;
    public $keyword;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, $keyword)
    {
        //
        $this->user = $user;
        $this->keyword = $keyword;

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
