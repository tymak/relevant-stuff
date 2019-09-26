<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    public function building()
    {
        return $this->hasOne('App\Building');
    }
}
