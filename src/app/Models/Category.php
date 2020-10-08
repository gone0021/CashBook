<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    protected $guarded = array('id');
    use SoftDeletes;

  protected $table = 'category';
    /**
     * itemsとのリレーション
     *
     * @return void
     */
    public function item()
    {
        return $this->belongsTo('App\Models\Item');
    }

    /**
     * kubunのリレーション
     *
     * @return void
     */
    public function kubun()
    {
        return $this->hasOne('App\Models\Kubun');
    }
}
