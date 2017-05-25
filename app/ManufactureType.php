<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class ManufactureType extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'manufacture_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function manufactures()
    {
        return $this->hasMany(Manufacture::class, 'type_id');
    }
}
