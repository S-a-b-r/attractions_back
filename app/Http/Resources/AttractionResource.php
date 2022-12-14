<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AttractionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'wiki_info' => $this->wiki_info,
            'wiki_info_link' => $this->wiki_info_link,
            'images' => ImageResource::collection($this->images),
            'creator' => $this->creator->name,
            'created_at' => $this->created_at
        ];
    }
}
