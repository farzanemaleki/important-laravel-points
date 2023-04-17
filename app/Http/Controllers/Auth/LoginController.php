<?php
namespace App\Http\Controllers\Auth;
use Illuminate\Routing\Controller;

class LoginController extends Controller{

    // protected $twoFactor;
    // use ThrottlesLogins;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        // $this->twoFactor = $twoFactor;
    }


    public function showLoginForm()
    {
        return view('auth.login');
    }
}