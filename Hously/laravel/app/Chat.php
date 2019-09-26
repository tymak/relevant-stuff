<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    public function community()
    {
        return $this->belongsTo('App\Community');
    }
}
