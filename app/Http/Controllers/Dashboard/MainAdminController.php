<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Session;

class MainAdminController extends Controller
{
    protected $check_permission = "";


     public function __construct()
     {
        $this->middleware(function ($request, $next) {
          if(Auth::user()->role->name == "admin")
          {
              $user_permissions = Session::get('permissions');
              if(Auth::id() != 1)
              {
                if(is_array($user_permissions) )
                {
                  if(!in_array($this->check_permission,$user_permissions))
                    return redirect('dashboard/nopermission');
                }

              }
          }
          return $next($request);
        });

     }


}
