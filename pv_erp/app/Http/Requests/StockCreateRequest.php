<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockCreateRequest extends FormRequest
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
        return [
            'name' => 'required',
            'barcode' => 'required',
            'selling_price' => 'required',
            'buying_price' => 'required',
            'wholesale_price' => 'required',
            'uom_id' => 'required',
        ];
    }
}
