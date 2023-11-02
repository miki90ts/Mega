<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            'gender' => $this->gender,
            'birthday' => $this->birthday,
            'phone' => $this->phone,
            'mobile' => $this->mobile,
            'address' => $this->address,
            'city' => $this->city,
            'country_id' => $this->country_id,
            'job_position_id' => $this->job_position_id,
            'job_position' => JobPositionResource::make($this->whenLoaded('job_position')),
            'photo' => $this->photo ? asset('storage/user/photo/' . $this->photo) : 'https://www.medianama.com/wp-content/uploads/2018/04/Facebook-shadow.jpg.jpg',
        ];
    }
}
