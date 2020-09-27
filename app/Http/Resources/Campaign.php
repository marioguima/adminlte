<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class Campaign extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'start' => Carbon::createFromFormat('Y-m-d', $this->start)->format('d/m/Y'),
            'end' => Carbon::createFromFormat('Y-m-d', $this->end)->format('d/m/Y'),
            'start_monitoring' => Carbon::createFromFormat('Y-m-d H:i:s', $this->start_monitoring)->format('d/m/Y H:i:s'),
            'stop_monitoring' => Carbon::createFromFormat('Y-m-d H:i:s', $this->stop_monitoring)->format('d/m/Y H:i:s'),
            'description' => $this->description,
            'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d/m/Y H:i:s'),
            'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', $this->updated_at)->format('d/m/Y H:i:s'),
            'segmentations' => new SegmentationCollection($this->segmentations),
            'messages' => new MessageCollection($this->messages),
        ];
    }
}
