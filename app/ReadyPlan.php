<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class ReadyPlan extends Model
{
    protected $table = "ready_plan";
    protected $fillable = ['day_num','programme_design_id','recepe_id','set_num','suplement_serving_size'];
    public function programme()
    {
        return $this->belongsTo('App\Programme','programme_design_id');
    }
    public function recepe()
    {
        return $this->belongsTo('App\Receips','recepe_id');
    }
}
