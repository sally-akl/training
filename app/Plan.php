<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Plan extends Model
{
    protected $table = "package_user_plan";
    protected $fillable = ['day_num','package_id','user_id','programme_design_id','recepe_id','transaction_id'];
    public function package()
    {
        return $this->belongsTo('App\Package','package_id');
    }
    public function programme()
    {
        return $this->belongsTo('App\Programme','programme_design_id');
    }
    public function recepe()
    {
        return $this->belongsTo('App\Receips','recepe_id');
    }
}
