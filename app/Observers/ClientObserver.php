<?php

namespace App\Observers;

use App\Models\Client;
use Illuminate\Support\Str;

class ClientObserver
{
    /**
     * Handle the plan "creating" event.
     *
     * @param  \App\Models\Client  $plan
     * @return void
     */
    public function creating(Client $client)
    {

        $client->uuid = Str::uuid();
    }
}
