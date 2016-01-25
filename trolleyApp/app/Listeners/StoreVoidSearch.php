<?php

namespace App\Listeners;

use Log;
use App\Search;
use App\Events\VoidSearch;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class StoreVoidSearch
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
     * @param  VoidSearch  $event
     * @return void
     */
    public function handle(VoidSearch $event)
    {
        //
        Search::create([
            'user_id' => $event->user->id,
            'keyword' => $event->keyword,
        ]);
    }
}
