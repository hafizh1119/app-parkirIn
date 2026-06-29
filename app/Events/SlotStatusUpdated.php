<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SlotStatusUpdated implements ShouldBroadcast
{
    public function __construct(
        public int $slotId,
        public string $status,
        public int $areaParkirId
    ) {}

    public function broadcastOn()
    {
        return new Channel('area-parkir.' . $this->areaParkirId);
    }

    public function broadcastAs()
    {
        return 'slot.updated';
    }
}