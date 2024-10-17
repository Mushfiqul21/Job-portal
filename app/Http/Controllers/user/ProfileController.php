<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index(){
        $data['user'] = Auth::user();
        $data['breadcrumb'] = 'Profile';
        return view('frontend.profile.profile', $data);
    }

    public function update(Request $request){
        try{
            $validateData = Validator::make($request->all(),[
                'name' => 'required',
                'email' => 'required',
                'designation' => 'required',
                'phone' => 'required',
            ]);

                $user = Auth::user();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->designation  = $request->designation;
                $user->phone = $request->phone;

            if ($request->hasFile('image')) {
                    $user->image = uploadImage($request->file('image'), 'images',$user->image);
                }
                $user->save();
                session()->flash('profile_success', 'Profile updated successfully');
                return redirect()->route('profile');

        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
}
