<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flat extends Model
{
    public function resident()
    {
        return $this->hasOne('App\Resident');
    }

    public function building()
    {
        return $this->belongsTo('App\Building');
    }
}
