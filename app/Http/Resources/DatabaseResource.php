<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DatabaseResource extends JsonResource
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
            'databaseType' => DatabaseTypeResource::make($this->whenLoaded('databaseType')),
            'logins' => LoginResource::collection($this->whenLoaded('logins')),
            'name' => $this->name,
            'server_ip' => $this->server_ip,
        ];
    }
}
