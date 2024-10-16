<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\isNull;

class UserController extends Controller
{
    public function index(){
        $data['breadcrumb'] = "Users";
       $data['users'] = User::orderBy('created_at', 'desc')->paginate(5);
       return view('backend.user.index', $data);
    }

    public function view($id){
        $data['user'] = User::find(decrypt($id));
        $data['breadcrumb'] = "User View";
        return view('backend.user.view', $data);
    }

    public function destroy($id){
        try{
            $user = User::find(decrypt($id));
            if(is_null($user)){
                session()->flash('error_message', 'User not found');
            }
            $user->delete();
            session()->flash('message', 'User has been deleted');
            return redirect()->route('users');
        }
        catch(\Exception $e){
            return $e->getMessage();
        }
    }
}
