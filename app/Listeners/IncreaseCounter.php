<?php

namespace App\Listeners;

use App\Events\Viewer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncreaseCounter
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
     * @param  object  $event
     * @return void
     */
    public function handle(Viewer $event)
    {
        $this ->incrview( $event -> video);
    }

    public function incrview($event) {
        $event ->viewers = $event ->viewers + 1;
        $event ->save();
    }
}
