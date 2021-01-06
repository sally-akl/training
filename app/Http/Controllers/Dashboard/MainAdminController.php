<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class MainAdminController extends Controller
{
    protected $check_permission = "";


     public function __construct()
     {
        $this->middleware(function ($request, $next) {
            $user_permissions = Session::get('permissions');
            if(is_array($user_permissions) )
            {
              if(!in_array($this->check_permission,$user_permissions))
                return response()->json(['redirect'=>"/dashboard/nopermission"],200);
            }
            return $next($request);
        });

     }


}
