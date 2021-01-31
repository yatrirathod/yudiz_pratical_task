<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->user_type == 'Admin') {
            return redirect('/home');
        }
        elseif($user->user_type == 'User') {
        return redirect('/product');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function showAdminLoginForm(){

        return view('auth.login',['url' => 'admin']);
    }

    public function adminLogin(Request $request){

        $this->validate($request,['email' => 'required|email',
                                    'password' => 'required| min:6'
            
        ]);

        if(Auth::user()->attempt(['email' => $request->email,'password' => $request->password, 'user_type' => 'Admin'], $request->get('remember'))){
                return redirect()->route('home');
            }
            return back()->withInput($request->only('email','remember'));
    }
}
