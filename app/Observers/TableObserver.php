<?php

namespace App\Observers;

use App\Models\Table;
use Illuminate\Support\Str;

class TableObserver
{
    /**
     * Handle the plan "creating" event.
     *
     * @param  \App\Models\Product  $plan
     * @return void
     */
    public function creating(Table $table)
    {
        $table->uuid = Str::uuid();
    }
}
