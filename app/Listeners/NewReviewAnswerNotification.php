<?php

namespace App\Listeners;

use App\Events\NewReviewAnswer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewReviewAnswerNotification
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
     * @param  \App\Events\NewReviewAnswer  $event
     * @return void
     */
    public function handle(NewReviewAnswer $event)
    {
        //
    }
}
