<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationResource extends JsonResource
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
            'client' => ClientResource::make($this->whenLoaded('client')),
            'name' => $this->name,
            'servers' => ServerResource::collection($this->whenLoaded('servers')),
            'databases' => DatabaseResource::collection($this->whenLoaded('databases')),

        ];
    }
}
