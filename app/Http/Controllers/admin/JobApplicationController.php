<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    public function index(){
        $data['applications'] = JobApplication::orderBy('created_at', 'desc')->with('job','user','employer')->paginate(5);
        $data['breadcrumb'] = 'Job Applications';
        return view('backend.job-applications.index', $data);
    }
}
