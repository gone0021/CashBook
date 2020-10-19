<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kubun extends Model
{
    protected $table = 'kubun';
    protected $guarded = array('id');
    use SoftDeletes;

    /**
     * categoryとのリレーション
     *
     * @return void
     */
    public function item()
    {
        return $this->hasOne('App\Models\Item');
    }

    /**
     * categoryとのリレーション
     *
     * @return void
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
