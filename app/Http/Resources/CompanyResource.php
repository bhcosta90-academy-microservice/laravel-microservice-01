<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            'id' => $this->uuid,
            'name' => $this->name,
            'slug' => $this->url,
            'category' => new CategoryResource($this->category),
            'whatsapp' => $this->whatsapp,
            'email' => $this->email,
            'phone' => $this->phone,
            'facebook' => $this->facebook,
            'instagram' => $this->instagram,
            'youtube' => $this->youtube,
            'image' => $this->image,
        ];
    }
}
