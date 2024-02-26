<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UOMCreateRequest extends FormRequest
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
        dd('-----------', Request());
        if(1==1){
            return [
                'name' => 'required',
                'symbol' => 'required',
                'unit' => 'required',
            ];
        }else {
            return [
                'editName' => 'required',
                'editSymbol' => 'required',
                'editUnit' => 'required',
            ];
        }
    }
}
