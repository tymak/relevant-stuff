<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    public function residents()
    {
        return $this->belongsTo('App\Resident');
    }
}
