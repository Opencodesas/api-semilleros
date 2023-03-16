<?php

namespace App\Events;

use App\Models\Contract;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ContractCancellation
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The contract instance.
     *
     * @var \App\Models\Contract
     */
    public $contract;
 
    /**
     * Create a new event instance.
     *
     * @param  \App\Models\Contract  $contract
     * @return void
     */
    public function __construct(Contract $contract)
    {
        $this->contract = $contract;
    }
}
