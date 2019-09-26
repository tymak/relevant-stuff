<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    public function noticeboard()
    {
        return $this->belongsTo('App\Noticeboard', 'id' , 'noticeboard_id');
    }
}
