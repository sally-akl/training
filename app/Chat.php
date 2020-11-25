<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Chat extends Model
{
    protected $table = "chat";
    public function  user()
    {
        return $this->belongsTo("App\User", 'from_user');
    }
}
