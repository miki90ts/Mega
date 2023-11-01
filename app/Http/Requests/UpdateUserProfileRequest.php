<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'job_position_id' => ['required', 'integer'],
            'gender' => ['required', 'integer'],
            'phone' => ['required', 'string', 'max:255'],
            'birthday' => ['required', 'date'],
            'mobile' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'city' => ['nullable', 'string'],
            'country_id' => ['nullable', 'integer'],
        ];
    }
}
