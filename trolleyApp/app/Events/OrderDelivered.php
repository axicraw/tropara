<?php

namespace App\Events;

use App\User;
use App\Checkout;
use App\Order;
use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OrderDelivered extends Event
{
    use SerializesModels;

    public $user;
    public $checkout;
    public $order;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Checkout $checkout)
    {
        //
         $this->user = $user;
        $this->checkout = $checkout;
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
