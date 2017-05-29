<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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


    public function typeId()
    {
        return $this->belongsTo(ManufactureType::class);
    }
}
