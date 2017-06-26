<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Manufacture
 * @package App
 *
 * @property ManufactureType $manufactureType
 */
class Manufacture extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'type_id',
        'phone',
        'email',
        'web_site',
        'inn',
        'ederpou',
        'mfo',
        'rr',
        'bank',
        'description',
        'account_debt'
    ];

    /**
     * This is relationship with manufacture_type manufacture for admin panel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function typeId()
    {
        return $this->belongsTo(ManufactureType::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function manufactureType()
    {
        return $this->belongsTo(ManufactureType::class, 'type_id', 'id');
    }
}
