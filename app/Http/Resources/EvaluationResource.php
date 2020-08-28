<?php

namespace App\Http\Resources;

use App\Models\Client;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ClientResource;
use Illuminate\Http\Resources\Json\JsonResource;

class EvaluationResource extends JsonResource
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
            'stars' => $this->stars,
            'comment' => $this->comment,
            'client' => new ClientResource($this->client),
            //'order' => new ClientResource($this->order),
        ];
    }
}
