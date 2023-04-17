<?php
namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    public function __construct(){
        $this->middleware('guest');
    }

    protected function create(array $data){
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone_number' => $data['phone_number']
        ]);
    }

    public function showRegisterForm(){
        return view('auth.register');
    }

    public function register(Request $request){
    
        $this->validateForm($request);
        $user = $this->create($request->all());
        Auth::login($user);
        return redirect(RouteServiceProvider::HOME)->with('registerd', true);
        
    }

    private function validateForm(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone_number' => ['numeric', 'digits:11', 'nullable']
        ]);
    }


    
}