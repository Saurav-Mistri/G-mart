<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\verifyuser;
use App\Mail\verifymail;
use Carbon\Carbon;
use App\Rules\PhoneNumber;
class LoginController extends Controller
{
    public function index()
    {
        //For interacting index page
        return view('user.index');
    }
    public function signup()
    {
        //For interacting signup page
        return view('user.signup');
    }
    //storing data
    public function store(Request $request)
    {
        //validate the data
        $request->validate([
            'name' => 'required|string|max:255',
            'phn' => 'required|numeric|digits:10',
            'email' => 'required|string|email|max:255|unique:users,email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'password' => 'required|string|max:8|min:8|confirmed',
            'password_confirmation' => 'required|string|max:8|min:8',
        ]);
        $user = User::create([
            'name' => $request->name,
            'phn' => $request->phn,
            'email' => $request->email,
            'password'=>bcrypt($request->password),
        ]);
        
        verifyuser::create([
            'token'=>Str::random(60),
            'user_id'=>$user->id,
        ]);
        Mail::to($user->email)->send(new verifymail($user));
        return redirect(route('user.signin'))->with('success','Please click on the link sent to your email');
    }

    //verifying email
    public function verifyEmail($token)
    {
        $verifieduser = verifyuser::where('token',$token)->first();
        if(isset($verifieduser))
        {
            $user = $verifieduser->user;
            if(!$user->email_verified_at)
            {
                $user->email_verified_at = Carbon::now();
                $user->save();
                //if user's email is successfully verified
                return redirect(route('user.signin'))->with('success','Your email has been successfully verified');
            }
            else
            {
                //if user's email is already verified
                return redirect()->back()->with('info','Your email has already been verified');
            }
        }
        else{
            //if token mismatch
            return redirect(route('user.signin'))->with('error','Oops..! Something went wrong..!!');
        }
    }
    //signin part start
    public function login()
    {
        //For interacting signin page
        return view('user.signin');
    }
    public function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        //For signin
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            if(Auth::user()->email_verified_at == null)
            {
                Auth::logout();
                return redirect(route('user.signin'))->with('error','Please verify your email to continue');
            }
            return redirect(route('user.index'))->with('success','Logged in successfully');
        }
        else
        {
            return redirect()->back()->with('error','Invalid email or password..!');
        }
    }
    public function destroy()
    {
        auth()->logout();
        return redirect(route('user.signin'));
    }
}
