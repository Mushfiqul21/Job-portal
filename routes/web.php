<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\JobDetailController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\user\JobController;
use App\Http\Controllers\user\PasswordSettingController;
use App\Http\Controllers\user\ProfileController;
use App\Http\Controllers\user\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/',[HomeController::class,'index'])->name('home');

Route::get('registration',[AuthController::class,'registration'])->name('registration');
Route::post('registration',[AuthController::class,'registrationPost'])->name('registration.post');

Route::get('login',[AuthController::class,'login'])->name('login');
Route::post('login',[AuthController::class,'loginPost'])->name('login.post');


Route::middleware(['auth'])->group(function(){
    Route::get('logout',[AuthController::class,'logout'])->name('logout');

    Route::get('profile',[ProfileController::class,'index'])->name('profile');
    Route::post('profile',[ProfileController::class,'update'])->name('profile.update');

    Route::post('profile/password-update/{id?}',[PasswordSettingController::class,'passwordUpdate'])->name('password.update');

    Route::group(['prefix' => 'job', 'as' => 'job.'], function(){
        Route::get('create',[JobController::class,'create'])->name('create');

        Route::post('store',[JobController::class,'store'])->name('store');

        Route::get('show',[JobController::class,'show'])->name('show');
        Route::get('edit/{id}',[JobController::class,'edit'])->name('edit');

        Route::post('update/{id}',[JobController::class,'update'])->name('update');

        Route::delete('destroy/{id}',[JobController::class,'destroy'])->name('destroy');

        Route::get('/',[JobController::class,'jobs'])->name('jobs');
        Route::get('/detail/{id}',[JobController::class,'jobDetails'])->name('detail');

        Route::post('/apply',[JobController::class,'applyJob'])->name('apply');
        Route::get('/applied',[JobController::class,'appliedJobs'])->name('applied');
        Route::get('/applied/delete/{id}',[JobController::class,'deleteAppliedJobs'])->name('delete.applied');

        Route::post('/saved',[JobController::class,'savedJobs'])->name('saved');
        Route::get('/saved/list',[JobController::class,'savedJobsList'])->name('saved.list');
        Route::get('/saved/delete/{id}',[JobController::class,'deleteSavedJobs'])->name('delete.saved');
    });

    Route::middleware('checkRole')->group(function(){
        Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');
        Route::get('admin/users',[UserController::class,'index'])->name('users');
        Route::get('admin/users/view/{id}',[UserController::class,'view'])->name('users.view');
        Route::delete('admin/users/delete/{id}',[UserController::class,'destroy'])->name('users.delete');

        Route::get('admin/jobs',[JobDetailController::class,'index'])->name('admin.jobs');
        Route::post('admin/jobs/update/{id}', [JobDetailController::class, 'update'])->name('admin.jobs.update');
        Route::delete('admin/jobs/delete/{id}', [JobDetailController::class, 'destroy'])->name('admin.jobs.delete');

    });
});

