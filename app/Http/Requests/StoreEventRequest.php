<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'events'=> 'present|array',
            'events.*.name'=> 'required|string|max:5',
            'events.*.timestamp'=> 'required|integer',
            'events.*.user_id'=> 'required|string',
            'events.*.activity_id'=> 'required|string'
        ];
    }


}
