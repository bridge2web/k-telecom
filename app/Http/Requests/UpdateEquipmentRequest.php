<?php

namespace App\Http\Requests;

use App\Rules\SnMask;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEquipmentRequest extends FormRequest
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
            'equipment_type_id' => 'required|exists:equipment_type,id',
            'sn' => ['required', 'unique:equipment', 'max:10', new SnMask]
        ];
    }
}
