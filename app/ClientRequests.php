<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class ClientRequests extends Model
{
    protected $table = "requests";
    public function  user()
    {
        return $this->belongsTo("App\User", 'user_id');
    }
    public function messages()
    {
      return $this->hasMany('App\Messages','request_id');
    }
}
