<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMovementRequest extends FormRequest
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
            /*
            //'movement_category_id' => 'required|integer|between:1,18',
            'date' => 'date_format:"Y/m/d"|required',
            'value' => 'required|numeric|between:-9999.99,9999.99',
            //'type' => 'required|exists:expense,revenue',
            'description' => 'sometimes|required'
            */
        ];
    }
}
