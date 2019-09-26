<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function buildings()
    {
        return $this->hasMany('App\Building');
    }
}
