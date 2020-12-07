<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class RecepiesIntegrate extends Model
{
    protected $table = "receips_integration";
    public function programme()
    {
        return $this->belongsTo('App\Programme','programme_id');
    }
    public function integrate()
    {
        return $this->belongsTo('App\ProgrammeIntegrent','integrate_programme_id');
    }
}
