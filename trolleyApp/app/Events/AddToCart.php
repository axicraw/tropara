<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class AddToCart extends Event
{
    use SerializesModels;

    public $priceID;
    public $prodID;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($priceID, $prodID)
    {
        //
        $this->priceID = $priceID;
        $this->prodID = $prodID;
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
