<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Programme extends Model
{
    protected $table = "programm_designs";
    public function images()
    {
      return $this->hasMany('App\ProgrammeImages','programme_id');
    }
    public function integrate()
    {
      return $this->hasMany('App\ProgrammeIntegrent','programme_id');
    }
}
