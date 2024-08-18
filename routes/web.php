<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\TeamController;
use App\Http\Controllers\Backend\BookAreaController;
use App\Http\Controllers\Backend\RoomTypeController;
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

Route::get('/', [UserController::class, 'Index']);


Route::get('/dashboard', function () {
    return view('frontend.dashboard.user_dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'UserProfile'])->name('user.profile');
    Route::post('/profile/store', [UserController::class, 'UserStore'])->name('user.profile.store');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::get('/user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');
    Route::post('/user/change/password/store', [UserController::class, 'ChangePasswordStore'])->name('user.change.password.store');


});

require __DIR__.'/auth.php';


Route::middleware('auth' , 'roles:admin')->group(function () {
Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
Route::post('/admin/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');

});

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');



Route::middleware('auth' , 'roles:admin')->group(function () {
    // Team all route
    Route::controller(TeamController::class)->group(function(){
        Route::get('/All/Team', 'AllTeam')->name('all.team');
        Route::get('/Add/Team', 'AddTeam')->name('add.team');
        Route::post('/Team/Store', 'TeamStore')->name('team.store');
        Route::get('/Team/Edit/{id}', 'TeamEdit')->name('team.edit');
        Route::post('/Team/Update', 'TeamUpdate')->name('team.update');
        Route::get('/Team/dDelete/{id}', 'TeamDelete')->name('team.delete');

    });

    Route::controller(BookAreaController::class)->group(function(){
        Route::get('/BookArea', 'BookArea')->name('book.area');
        Route::post('/BookArea/Update', 'BookAreaUpdate')->name('book.area.update');
    });


    Route::controller(RoomTypeController::class)->group(function(){
        Route::get('/RoomType/List', 'RoomTypeList')->name('roomtype.list');
        Route::get('/RoomType/Add', 'AddRoomType')->name('add.roomtype');
        Route::post('/RoomType/Store', 'AddRoomStore')->name('roomtype.store');

    });


});