<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class TweetResource extends JsonResource
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
            'person_id' => $this->person_id,
            'name' => $this->name,
            'comment' => $this->comment,
            'created_at' => (Carbon::parse($this->created_at))->format("H:i:s"),
            'updated_at' => (Carbon::parse($this->updated_at))->format("H:i:s"),
        ];
    }
}
