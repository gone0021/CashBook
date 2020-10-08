<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kubun extends Model
{
    protected $guarded = array('id');
    use SoftDeletes;
    protected $table = 'kubun';

    /**
     * categoryとのリレーション
     *
     * @return void
     */
    public function item()
    {
        return $this->belongsTo('App\Models\Item');
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
