<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\admin\AdminHomeController;
use App\Http\Controllers\admin\AdminProfileController;
use App\Http\Controllers\sector\HomeController;
use App\Http\Controllers\sector\ProfileController;
use GuzzleHttp\Middleware;
use App\Http\Controllers\DefaultHomeController;

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

Route::get('/', function () {
    return view('welcome');
});



Route::get('/home', [DefaultHomeController::class, 'index'])->middleware('auth')->name('home');




// Route::middleware('guest')->group(function () 
// {
//     Route::get('register', [RegisteredUserController::class, 'create'])
//                 ->name('register');

//     Route::post('register', [RegisteredUserController::class, 'store']);
//     Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');

//     Route::post('login', [AuthenticatedSessionController::class, 'store']);
// });
// Route::get('/verify/{token}/{email}', [RegisteredUserController::class, 'verifyAccount'])->name('verify_account');
// // Route::post('logout',[ AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');



Route::middleware('guest')->group(function()
{
    Route::get('register', [AuthController::class, 'registerpage'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
    Route::get('login', [AuthController::class, 'loginpage'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    
}
);


// Admin
Route::prefix('admin')->middleware(['auth','admin'])->group(function()

{

    Route::get('/dashboard', [AdminHomeController::class, 'create'])->name('admin_dashboard');   
    Route::get('profile' ,[AdminProfileController::class, 'show'])->name('admin_profile');
    Route::post('profile' ,[AdminProfileController::class, 'update']);
    
    
    
});



// user/ default
Route::prefix('sector')->middleware(['auth','sector'])->group(function()
{
    Route::get('/dashboard', [HomeController::class, 'create'])->name('dashboard');
    Route::get('profile' ,[ProfileController::class, 'show'])->name('edit_profile');
    Route::post('profile' ,[ProfileController::class, 'update']);
    
});


Route::get('/verify/{token}/{email}', [AuthController::class, 'verifyAccount'])->name('verify_account');
Route::post('logout',[AuthController::class, 'destroy'])->middleware('auth')->name('logout');












