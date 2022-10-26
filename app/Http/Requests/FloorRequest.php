<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FloorRequest extends FormRequest
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
            'name_floor_hd' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name_floor_hd.required' => 'Tên tầng không được để trống.',
        ];
    }
}