<?php


namespace chatty\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use chatty\Models\User;
use Auth;

/**
* 
*/
class AuthController extends Controller
{
	
	public function getSignup(){

		return view('auth.signup');
	}

	public function postSignup(Request $request){

		$this->validate($request,[
          'email'=>'required|unique:users|email|max:255',
          'username'=>'required|unique:users|alpha_dash|max:20',
          'password'=>'required|min:6',
			]);

		
		User::create([

            'email'=>$request->input('email'),
            'username'=>$request->input('username'),
            'password'=>bcrypt($request->input('password')),
			]);
		return redirect()->route('home')->with('info','your account has been created you can sign in');
	}

	public function getSignin(){

		return view('auth.signin');
	}
	
	public function postSignin(Request $request){
	$this->validate($request,[
          'email'=>'required',
          'password'=>'required',
			]);
        if (!Auth::attempt($request->only(['email','password']),$request->has('remember'))) {
        	return redirect()->back()->with('info',' you cannot  sign in');
        }
        return redirect()->route('home')->with('info',' you had signned in');
	}

	public function getSignout(){

		Auth::logout();
		return redirect()->route('home');
	}

}
