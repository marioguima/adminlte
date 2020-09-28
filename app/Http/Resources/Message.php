<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class Message extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'shot' => $this->pivot->shot,
            'scheduler_date' => $this->pivot->scheduler_date,
            'quantity' => $this->pivot->quantity,
            'unit' => $this->pivot->unit,
            'trigger' => $this->pivot->trigger,
            'moment' => $this->pivot->moment,
            'created_at' => $this->pivot->created_at,
            'updated_at' => $this->pivot->updated_at,
            'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', $this->updated_at)->format('Y-m-d H:i:s'),
            'items' => new MessageItemCollection($this->items)
        ];
        // return parent::toArray($request);
    }
}
