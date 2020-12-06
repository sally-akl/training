<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Receips extends Model
{
    protected $table = "receips";
    public function integrate()
    {
      return $this->hasMany('App\RecepiesIntegrate','recep_id');
    }
}
