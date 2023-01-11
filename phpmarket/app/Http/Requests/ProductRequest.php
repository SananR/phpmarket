<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProductRequest extends FormRequest
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
            'store_id'=>['required','max:30'],
            'name'=>['required','max:60'],
            'bin'=>['required','numeric','unique:App\Models\Product'],
            'quantity'=>['required','digits_between:0,999999'],
        ];
    }
}
