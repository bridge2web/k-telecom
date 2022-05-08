<?php

namespace App\Http\Requests;

use App\Rules\SnMask;
use Illuminate\Foundation\Http\FormRequest;

class StoreEquipmentRequest extends FormRequest
{
    /**
     * Indicates whether validation should stop after the first rule failure.
     *
     * @var bool
     */
    protected $stopOnFirstFailure = true;

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
            'sn' => ['exclude_if:equipment_type_id,false', 'required', 'unique:equipment', 'max:10', new SnMask],
            'note' => 'nullable|string'
        ];
    }
}
