<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use App\Models\JobType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    public function create(){
        $data['categories'] = Category::orderBy('name','asc')->where('status',1)->get();
        $data['jobTypes'] = JobType::orderBy('name','asc')->where('status',1)->get();
        $data['breadcrumb'] = "Post a Job";
        return view('frontend.job.create',$data);
    }

    public function store(Request $request){
        try{
            $validateData = Validator::make($request->all(),[
                'title' => 'required',
                'category' => 'required',
                'job_type' => 'required',
                'vacancy' => 'required',
                'location' => 'required',
                'description' => 'required',
                'company_name' => 'required',
            ]);

            if($validateData->passes()){
                $job = new Job();
                $job->title = $request->title;
                $job->category_id = $request->category;
                $job->job_type_id = $request->job_type;
                $job->user_id = Auth::user()->id;
                $job->vacancy  = $request->vacancy;
                $job->salary = $request->salary;
                $job->location = $request->location;
                $job->description = $request->description;
                $job->benefits = $request->benefits;
                $job->responsibility = $request->responsibility;
                $job->qualifications = $request->qualifications;
                $job->requirements = $request->requirements;
                $job->keywords = $request->keywords;
                $job->experience  = $request->experience;
                $job->company_name = $request->company_name;
                $job->company_location = $request->company_location;
                $job->company_website = $request->company_website;
                $job->save();

                session()->flash('message','Job posted successfully');
                return redirect()->route('job.show');

            }else{
                return redirect()->back()->withErrors($validateData->errors())->withInput();
            }
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    public function show(){
        $data['breadcrumb'] = "Jobs";
        $data['jobs'] = Job::where('user_id', Auth::user()->id)->with('jobType')->paginate(2);
        return view('frontend.job.index',$data);
    }

    public function edit($id){
        $data['categories'] = Category::orderBy('name','asc')->where('status',1)->get();
        $data['jobTypes'] = JobType::orderBy('name','asc')->where('status',1)->get();
        $data['breadcrumb'] = "Post a Job";
        $data['job'] = Job::find(decrypt($id));
        return view('frontend.job.edit',$data);
    }

    public function update(Request $request, $id){
        try{
            $validateData = Validator::make($request->all(),[
                'title' => 'required',
                'vacancy' => 'required',
                'description' => 'required',
            ]);

            if($validateData->passes()){
                $job = Job::find(decrypt($id));
                $job->title = $request->title;
                $job->category_id = $request->category;
                $job->job_type_id = $request->job_type;
                $job->vacancy  = $request->vacancy;
                $job->salary = $request->salary;
                $job->location = $request->location;
                $job->description = $request->description;
                $job->benefits = $request->benefits;
                $job->responsibility = $request->responsibility;
                $job->qualifications = $request->qualifications;
                $job->requirements = $request->requirements;
                $job->keywords = $request->keywords;
                $job->experience  = $request->experience;
                $job->company_name = $request->company_name;
                $job->company_location = $request->company_location;
                $job->company_website = $request->company_website;
                $job->save();

                session()->flash('message','Job updated successfully');
                return redirect()->route('job.show');

            }else{
                return redirect()->back()->withErrors($validateData->errors())->withInput();
            }
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    public function destroy($id){
        try{
            $job = Job::find(decrypt($id));
            if(is_null($job)){
                return redirect()->back();
            }
            $job->delete();
            session()->flash('message','Job deleted successfully');
            return redirect()->route('job.show');
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    public function jobs(){

        $data['categories'] = Category::where('status',1)->get();
        $data['jobTypes'] = JobType::where('status',1)->get();
        $data['jobs'] = Job::where('status',1)->with('jobType')->orderBy('created_at','desc')->paginate(9);

        return view('frontend.job.view', $data);
    }
}
