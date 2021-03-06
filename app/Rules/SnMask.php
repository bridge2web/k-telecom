<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Log;
use App\Models\EquipmentType;

class SnMask implements Rule, DataAwareRule
{
    /**
     * All of the data under validation.
     *
     * @var array
     */
    protected $data = [];

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        if (strpos($attribute, '.') !== false) { // is array
            $index = (int)strtok($attribute, '.');
            $typeId = $this->data[0]['equipment_type_id'];
        } else {
            $typeId = $this->data['equipment_type_id'];
        }
        $type = EquipmentType::find($typeId);
        $mask = $type->sn_mask;
        return $this->check($value, $mask);
    }

    /**
     * Set the data under validation.
     *
     * @param  array  $data
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The serial number is not valid.';
    }

    /**
     * Check SN by mask
     *
     * @param  string  $value
     * @param  string  $mask
     * @return bool
     */
    private function check($sn, $mask)
    {
        if (strlen($sn) != strlen($mask))
            return false;

        $charToRegex = [
            'N' => '[0-9]',
            'A' => '[A-Z]',
            'a' => '[a-z]',
            'X' => '[A-Z0-9]',
            'Z' => '[-|_|@]'
        ];

        $maskChars = str_split($mask);

        $regex = '/^';
        foreach ($maskChars as $char) {
            $regex .= $charToRegex[$char];
        }
        $regex .= '/';

        //Log::debug($regex);

        return preg_match($regex, $sn) > 0 ? true : false;
    }
}
