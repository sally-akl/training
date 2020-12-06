<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Plan extends Model
{
    protected $table = "package_user_plan";
    public function package()
    {
        return $this->belongsTo('App\Package','package_id');
    }
    public function programme()
    {
        return $this->belongsTo('App\Programme','programme_design_id');
    }
}
