<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Client;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $table = "order_evaluations";


    public function order()
    {
        return $this->belongTo(Order::class);
    }

    public function client()
    {
        return $this->belongTo(Client::class);
    }
}
