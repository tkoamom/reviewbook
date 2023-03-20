<?php

namespace App\Listeners;

use App\Events\NewReview;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewReviewNotification
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
     * @param  \App\Events\NewReview  $event
     * @return void
     */
    public function handle(NewReview $event)
    {
        //
    }
}
