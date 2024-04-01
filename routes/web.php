<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


        //admin route midlleware
Route::middleware(['auth','role:admin'])->group(function(){

Route::get('/Admin/Dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
Route::get('/Admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
Route::get('/Admin/Profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
Route::post('/Admin/Profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');


});// end group for admin middleware


        //agent route midlleware
Route::middleware(['auth','role:agent'])->group(function(){

Route::get('/Agent/Dashboard', [AgentController::class, 'AgentDashboard'])->name('agent.dashboard');

});// end group for agent middleware



Route::get('/Admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

require __DIR__.'/auth.php';
