<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{

    public function owner()
    {
        return $this->belongsTo('App\Owner');
    }

    public function administrator()
    {
        return $this->hasOne('App\Administrator');
    }

    public function noticeboard()
    {
        return $this->hasOne('App\Noticeboard');
    }

    public function flats()
    {
        return $this->hasMany('App\Flat');
    }
}
