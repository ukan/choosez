<?php

namespace App\Events\Backend;

use App\Models\User;
use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Cartalyst\Sentinel\Reminders\EloquentReminder as Reminder;

class AdminAlertEvent extends Event
{
    use SerializesModels;

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
