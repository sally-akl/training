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
}
