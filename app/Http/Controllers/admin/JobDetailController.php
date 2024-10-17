<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;

class JobDetailController extends Controller
{
    public function index(){
        $data['breadcrumb'] = 'Job List';
        $data['jobs'] =Job::orderBy('created_at', 'desc')->with('user')->paginate(4);
        return view('backend.jobs.index',$data);
    }
    public function update(Request $request, $id)
    {
        try{
            $job = Job::find($id);
            $job->status = $request->status;
            $job->isFeatured = $request->isFeatured;
            $job->save();
            session()->flash('message', 'Job updated successfully');
            return redirect()->route('admin.jobs');
        }
        catch(\Exception $e){
            return $e->getMessage();
        }
    }
    public function destroy($id){
        try{
            $job = Job::find($id);
            if(is_null($job)){
                return redirect()->back();
            }
            $job->delete();
            session()->flash('message','Job deleted successfully');
            return redirect()->route('admin.jobs');
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
}
