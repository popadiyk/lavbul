<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Group
 * @package App
 * @property \Illuminate\Database\Eloquent\Relations\HasMany products
 */
class Group extends Model
{
    /**
     * @var string
     */
    protected $table = 'groups';

    /**
     * @var array
     */
    protected $fillable = [
      'title'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    protected function products()
    {
        return $this->hasMany(Product::class);
    }

    public function ProductCategory(){
        return $this->hasMany($this, 'group_id');
    }

    public function rootCategories(){
        return $this->where('group_id', 0)->with('ProductCategory')->get();
    }
}
