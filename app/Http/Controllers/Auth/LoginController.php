<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    //função autenticar se utilizador tiver a conta activa
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $email = $credentials['email'];
        $password = $credentials['password'];
        if (Auth::attempt(['email' => $email, 'password' => $password, 'estado' => 1])) {
            //return redirect()->intended('home');
            $info = 'Sucesso';
        }else{
            //return redirect()->intended('/');
            $info = 'Erro';
        }
        echo $info;  
    }
}
