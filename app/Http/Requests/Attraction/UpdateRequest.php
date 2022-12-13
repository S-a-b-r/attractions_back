<?php

namespace App\Http\Requests\Attraction;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'remember_token'=>'required|string|exists:users,remember_token',
            'title'=>'string|max:255',
            'description'=>'string',
            'latitude'=>'numeric',
            'longitude'=>'numeric',
            'is_published' => 'boolean'
        ];
    }
}
