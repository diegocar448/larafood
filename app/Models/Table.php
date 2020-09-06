<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $table = "tables";

    use TenantTrait;

    protected $fillable = [
        'identify',
        'description'
    ];
}
