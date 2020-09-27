<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class Group extends JsonResource
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
            'description' => $this->description,
            'edit_data' => $this->edit_data,
            'send_message' => $this->send_message,
            'seats' => $this->seats,
            'occuped_seats' => $this->occuped_seats,
            'people_left' => $this->people_left,
            'url' => $this->url,
            'full_image_path' => $this->full_image_path,
            'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d/m/Y H:i:s'),
            'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', $this->updated_at)->format('d/m/Y H:i:s'),
            'initial_members' => new InitialMemberCollection($this->initialMembers)
        ];
        // return parent::toArray($request);
    }
}
