<?php

namespace App\Http\Requests\store;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateRequest extends FormRequest
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
            'name'=>['max:30'],
            'address'=>['max:60', 'unique:App\Models\Store'],
            'longitude'=>['decimal:6'],
            'latitude'=>['decimal:6'],
        ];
    }
}
