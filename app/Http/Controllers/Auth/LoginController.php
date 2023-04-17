<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;


class LoginController extends Controller{

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
        return view('auth.login');
    }

    public function login(Request $request){
        
        $this->validateForm($request); 
        $this->ensureIsNotRateLimited($request); 

        if($this->attemptLogin($request)){
            RateLimiter::clear($this->throttleKey($request));
            return $this->sendSuccessResponse();
        }

        RateLimiter::hit($this->throttleKey($request), $seconds = 60);
        return $this->sendLoginFailedResponse();
    }

    protected function validateForm(Request $request){
        return $request->validate([
            'email' => ['required', 'email', 'exists:users'],
            'password' => ['required'],
        ]);
    }

    protected function attemptLogin(Request $request){
        return Auth::attempt($request->only('email', 'password'), $request->filled('remember'));
    }

    protected function sendSuccessResponse(){
        session()->regenerate();
        return redirect()->intended();
    }

    protected function sendLoginFailedResponse(){
        return back()->with('wrongCredentials', true);
    }

    public function logout(){
        session()->invalidate();
        Auth::logout();
        return redirect()->route('home');
    }

    protected function ensureIsNotRateLimited(Request $request)
    {
        if (! RateLimiter::tooManyAttempts( $this->throttleKey($request), 2)) {
            return;
        }

        $seconds = RateLimiter::availableIn($this->throttleKey($request));
 
        throw ValidationException::withMessages([
            'throttle' => trans('auth.throttle', ['seconds' => $seconds]),
        ]);
    }

    public function throttleKey(Request $request): string
    {
        return Str::transliterate(Str::lower($request->input($this->username())).'|'.$request->ip());

    }

    protected function username(){
        return 'email';
    }
}