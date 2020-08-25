<?php

namespace App\Http\Resources;

use App\Http\Resources\TableResource;
use App\Http\Resources\ClientResource;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);

        return [
            'identify' => $this->identify,
            'total' => $this->total,
            'status' => $this->status,
            //Chamando um resource dentro de outro resource
            'client' => $this->client_id ? new ClientResource($this->client) : '',
            'table' => $this->table_id ? new TableResource($this->table) : '',
            'products' => ProductResource::collection($this->products),
        ];
    }
}
