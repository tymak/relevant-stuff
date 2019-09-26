<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Noticeboard extends Model
{

    public function building()
    {
        return $this->belongsTo('App\Building', 'id', 'building_id');
    }

    public function notices()
    {
        return $this->hasMany('App\Notice');
    }
}
