<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\HeroSection;
use App\Models\Job;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index(){
        $data['categories'] = Category::where('status',1)
                                ->orderBy('name','asc')
                                ->take(8)
                                ->get();
        $data['new_category'] = Category::where('status',1)
                                ->orderBy('name','asc')
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
        $data['hero'] = HeroSection::first();
        return view('frontend.home',$data);
    }

    public function createHero(){
        $data['breadcrumb'] = "Edit Hero Section";
        $data['hero'] = HeroSection::first();
        return view('backend.home.hero', $data);
    }
    public function updateHero(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'sub_title' => 'required',
            'bg_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $hero = HeroSection::first();
        $hero->title = $request->title;
        $hero->sub_title = $request->sub_title;
        if ($request->hasFile('bg_image')) {
            $hero->bg_image = uploadImage($request->file('bg_image'), 'images',$hero->bg_image);
        }
        $hero->save();
        session()->flash('message', 'Hero Section Updated Successfully');
        return redirect()->route('admin.home');
    }
}
