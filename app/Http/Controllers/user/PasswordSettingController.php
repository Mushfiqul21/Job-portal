<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class PasswordSettingController extends Controller
{
    public function passwordUpdate(Request $request, $id){
        try{
            $id = Crypt::decrypt($id);
            $this->validate($request,[
                'old_password' => 'required|min:6',
                'new_password' => 'required',
            ]);

            $user = User::find($id);
            if(!Hash::check($request->old_password, $user->password)){
                return back()->withErrors(['old_password' => 'Old password does not match']);
            }
            $user->password = Hash::make($request->new_password);
            $user->save();
            session()->flash('password_success', 'Password updated successfully');
            return redirect()->route('profile');

        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }
}
