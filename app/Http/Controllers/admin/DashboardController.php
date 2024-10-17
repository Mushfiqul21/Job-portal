<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $data['users'] = User::count();
        $data['jobs'] = Job::count();
        return view('backend.dashboard', $data);
    }
}
