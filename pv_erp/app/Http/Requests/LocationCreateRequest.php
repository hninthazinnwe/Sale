<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationCreateRequest extends FormRequest
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
        if(Request()->has('btnCreate')) {
            return [
                'name' => 'required',
                'address' => 'required',
                'phone' => 'required',
                'email' => 'required',
            ];
        }else {
            return [
                'editName' => 'required',
                'editAddress' => 'required',
                'editPhone' => 'required',
                'editEmail' => 'required',
            ];
        }
    }
}
