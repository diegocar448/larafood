<?php

namespace App\Tenant\Events;

use App\Models\User;
use App\Models\Tenant;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TenantCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    //////////////////////////////////////////////////////////////
    ////////////////Retorna Usuário Criado////////////////////////
    //////////////////////////////////////////////////////////////
    public function user(): User
    {
        return $this->user;
    }

    //////////////////////////////////////////////////////////////
    ////////////////Retorna Tenant  //////////////////////////////
    //////////////////////////////////////////////////////////////
    public function tenant(): Tenant
    {
        return $this->user->tenant;
    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
