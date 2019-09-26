<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    public function users()
    {
        return $this->belongsToMany('App\User', 'user_community');
    }

    public function chats()
    {
        return $this->hasMany('App\Chat');
    }
}
