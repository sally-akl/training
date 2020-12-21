<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Transactions extends Model
{
    protected $table = "transactions";
    public function  user()
    {
        return $this->belongsTo("App\User", 'user_id');
    }
    public function  trainer()
    {
        return $this->belongsTo("App\User", 'trainer_id');
    }
    public function  package()
    {
        return $this->belongsTo("App\Package", 'package_id');
    }
    public function chats()
    {
      return $this->hasMany('App\Chat','booking_id');
    }
    public function plan()
    {
      return $this->hasMany('App\Plan','transaction_id');
    }
}
