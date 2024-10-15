<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordSettingController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
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

        Route::get('destroy/{id}',[JobController::class,'destroy'])->name('destroy');

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
    });
});

