<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function flat()
    {
        return $this->hasOne('App\Flat');
    }

    public function contract()
    {
        return $this->hasMany('App\Contract');
    }
}
