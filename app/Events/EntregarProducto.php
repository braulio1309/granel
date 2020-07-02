<?php

namespace App\Events;

use App\Ventas;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EntregarProducto implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $venta;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($venta)
    {
        $this->venta = $venta;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('EntregarProducto');
        //PrivateChannel
    }
}
