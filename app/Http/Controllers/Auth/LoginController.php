<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Socialite;
use Auth;
use Exception;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers{

      logout as doLogout;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function showLoginForm()
    {
        return view('dashboard.auth.login');
    }
    public function logout(Request $request)
    {
        $this->doLogout($request);
        return redirect('/login');
    }
    protected function authenticated(\Illuminate\Http\Request $request, $user)
    {
        if($user->role->name == "admin")
        {
            Session::put('permissions', $user->getPermissions());

        }
        return redirect('/dashboard');
    }
    public function redirectToGoogle()
   {
       return Socialite::driver('google')->redirect();
   }

   public function handleGoogleCallback()
   {
      try{

          $user = Socialite::driver('google')->user();
          $finduser = User::where('google_id', $user->id)->first();

          if(isset($finduser->id)){

            Auth::login($finduser);
            return redirect('/');

          }else{
            $newUser = User::create([
              'name' => $user->name,
              'email' => $user->email,
              'role_id'=>3
            ]);
            $newUser->google_id = $user->id;
            $newUser->save();
            Auth::login($newUser);
            return redirect()->back();
          }

      } catch (Exception $e) {
          echo $e->getMessage();
           //return redirect('/auth-customer');
      }
   }
   public function redirectToApple()
   {
      return Socialite::driver('apple')->redirect();
   }
   public function handleAppleCallback()
   {
      try{
         $user = Socialite::driver('apple')->user();
         $finduser = User::where('apple_id', $user->id)->first();
         if(isset($finduser->id)){
           Auth::login($finduser);
           return redirect('/');
         }else{
           $newUser = User::create([
             'name' => $user->name,
             'email' => $user->email,
             'role_id'=>3
           ]);
           $newUser->google_id = $user->id;
           $newUser->save();
           Auth::login($newUser);
           return redirect()->back();
         }
      }
      catch (Exception $e) {
           return redirect('/auth-customer');
      }
   }
}
