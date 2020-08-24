<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    //protected $table = "table";

    use TenantTrait;

    protected $fillable = [
        'identify',
        'description'
    ];
}
