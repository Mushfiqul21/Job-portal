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
        $data['jobs'] = Job::where('user_id', Auth::user()->id)->with('jobType')->paginate(1);
        return view('frontend.job.index',$data);
    }
}
