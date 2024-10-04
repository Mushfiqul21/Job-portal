<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function registration(){
        return view('frontend.auth.registration');
    }

    public function registrationPost(Request $request){
        $validateData = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);
        if($validateData->passes()){
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            session()->flash('success', 'Registration Successful');

            return response()->json([
                'status' => true,
                ],200);

        }else{
            return response()->json(['status'=>false, 'error'=>$validateData->errors()],400);
        }

    }
    public function login(Request $request){
        return view('frontend.auth.login');
    }

    public function loginPost(Request $request){
        $validateData = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        if($validateData->passes()){
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                return redirect()->route('profile');
            }
            else{
                return redirect()->back()->with('error', 'Wrong Email or Password');
            }
        }
        else{
            return redirect()->back()->withInput($request->only('email'))->withErrors($validateData);
        }

    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
