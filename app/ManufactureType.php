<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ManufactureType
 * @package App
 */

class ManufactureType extends Model
{
    /**
     * @var string
     */
   protected $table = 'manufacture_types';

   /**
     * @var array
     */
    protected $fillable = ['title'];


    /**
     * This is relationship with manufactures
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function manufactures()
    {
        return $this->hasMany(Manufacture::class);
    }
}
