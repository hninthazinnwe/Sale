<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerCreateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        // dd(Request());
        return [
            'code' => 'nullable',
            'name' => 'required',
            'phone' => 'nullable',
            'address' => 'nullable',
            'email' => 'nullable',
        ];
    }
}
