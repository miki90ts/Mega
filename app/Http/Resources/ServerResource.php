<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'serverType' => ServerTypeResource::make($this->whenLoaded('serverType')),
            'logins' => LoginResource::collection($this->whenLoaded('logins')),
            'name' => $this->name,
            'description' => $this->description,
        ];
    }
}
