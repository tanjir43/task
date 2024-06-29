<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'         => 'required|max:200',
            'for_whom'      => 'nullable',
            'description'   => 'nullable|max:500',
            'location'      => 'nullable|max:200',
            'from_date'     => 'nullable',
            'to_date'       => 'nullable|after:from_date',
            'file'          => 'nullable|mimes:jpeg,jpg,png,gif,svg|max:3072',
            'is_specific'   => 'nullable',
            'country_id'    => 'nullable|required_if:is_specific,true',
            'city_id'       => 'nullable|required_if:is_specific,true',
        ];
    }
}
