<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\MasterClassUser;

class MasterClass extends Model
{
    protected $table = 'master_class';

    protected $fillable = [
        'title',
        'description',
        'master',
        'technology',
        'max_seats',
        'full_seets',
        'max_age',
        'duration',
        'price',
        'main_photo',
        'date_time',
        'place',
        'status'
    ];

    public function newUser(){
        return count(MasterClassUser::all()->where('mc_id', $this->id)->where('status', 'new'));
    }

    public function paidUser(){
        return count(MasterClassUser::all()->where('mc_id', $this->id)->where('status', 'want_to_pay')) +
        count(MasterClassUser::all()->where('mc_id', $this->id)->where('status', 'paid'));
    }


}
