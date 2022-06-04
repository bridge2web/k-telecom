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
        if ($this->isArray()) {
            return [
                '*.equipment_type_id' => 'required|exists:equipment_types,id',
                '*.sn' => ['exclude_if:equipment_type_id,false', 'required', 'distinct', 'unique:equipments', 'max:10', new SnMask],
                '*.note' => 'nullable|string'
            ];
        }
        return [
            'equipment_type_id' => 'required|exists:equipment_types,id',
            'sn' => ['exclude_if:equipment_type_id,false', 'required', 'unique:equipments', 'max:10', new SnMask],
            'note' => 'nullable|string'
        ];
    }

    public function isArray()
    {
        $validationData = $this->validationData();
        return isset($validationData[0]) && is_array($validationData[0]);
    }
}
