<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CTCTransaction implements ShouldDispatchAfterCommit
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private int $senderId;
    private int $receiverId;
    private int $transactionAmount;

    /**
     * Create a new event instance.
     */
    public function __construct(int $senderId, int $receiverId, int $amount)
    {
        $this->senderId = $senderId;
        $this->receiverId = $receiverId;
        $this->transactionAmount = $amount;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }

    public function getSender(): int
    {
        return $this->senderId;
    }

    public function getReceiver(): int
    {
        return $this->receiverId;
    }

    public function getTransactionAmount(): int
    {
        return $this->transactionAmount;
    }
}
