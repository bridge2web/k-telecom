<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'equipment';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var string[]|bool
     */
    protected $guarded = ['id'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the equipment type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function equipmentType()
    {
        return $this->belongsTo(EquipmentType::class);
    }
}
