<?php

namespace App\Events;

use App\Models\ReviewAnswer;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewReviewAnswer implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $reviewAnswer;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ReviewAnswer $reviewAnswer)
    {
        $this->reviewAnswer = $reviewAnswer;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('review.'. $this->reviewAnswer->id);
    }
}
