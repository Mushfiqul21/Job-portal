<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $data['categories'] = Category::where('status',1)
                                ->orderBy('name','asc')
                                ->take(8)
                                ->get();

        $data['featured_jobs'] = Job::where('status',1)
                                ->orderBy('created_at','desc')
                                ->with('jobType')
                                ->where('isFeatured',1)
                                ->take(6)
                                ->get();

        $data['latest_jobs'] = Job::where('status',1)
                                ->orderBy('created_at','desc')
                                ->take(6)
                                ->get();

        return view('frontend.home',$data);
    }
}
