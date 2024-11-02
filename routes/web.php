<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\TeamController;
use App\Http\Controllers\Backend\BookAreaController;
use App\Http\Controllers\Backend\RoomTypeController;
use App\Http\Controllers\Backend\RoomController;
use App\Http\Controllers\Frontend\FrontendRoomController;
use App\Http\Controllers\Frontend\BookingController;
use App\Http\Controllers\Backend\RoomListController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\GalleryController;
use App\Http\Controllers\Backend\ContactController;
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
        Route::get('/Team/Delete/{id}', 'TeamDelete')->name('team.delete');
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


    Route::controller(RoomController::class)->group(function(){
        Route::get('/Room/Edit/{id}', 'RoomEdit')->name('room.edit');
        Route::post('/Room/Update/{id}', 'RoomUpdate')->name('room.update');
        Route::get('/Room/multi_img/Delete/{id}', 'MultiImgDelete')->name('multi_img.delete');

        // Room Number
        Route::post('/RoomNumber/Store/{id}', 'RoomNumberStore')->name('store.roomnb');
        Route::get('/RoomNumber/Edit/{id}', 'RoomNumberEdit')->name('roomnb.edit');
        Route::post('/RoomNumber/Update/{id}', 'UpdateRoomNumber')->name('update.roomnb');
        Route::get('/RoomNumber/Delete/{id}', 'DeleteRoomNumber')->name('roomnb.delete');
        Route::get('/Room/Delete/{id}', 'DeleteRoom')->name('room.delete');
        
    });


    // booking

    Route::controller(BookingController::class)->group(function(){
        Route::get('/Bookings/List', 'BookingList')->name('booking.list');
        Route::get('/Bookings/Edit/{id}', 'EditBooking')->name('edit.booking');
        Route::post('/Booking/Update/Status/{id}', 'BookingUpdateStatus')->name('update.booking.status');
        Route::post('/Booking/Update/Date/{id}', 'BookingUpdateDate')->name('update.booking.date');
        Route::get('/assign_room/{id}', 'AssignRoom')->name('assign_room');
        Route::get('/assign_room/store/{booking_id}/{room_number_id}', 'AssignRoomStore')->name('assign_room_store');
        Route::get('/assign_room/Delete/{id}', 'AssignRoomDelete')->name('assign_room_delete');
        Route::get('/download/invoice/{id}', 'DownloadInvoice')->name('download.invoice');


    });

    Route::controller(RoomListController::class)->group(function(){

        Route::get('/view/Room/List', 'ViewRoomList')->name('view.room.list'); 
        Route::get('/Add/RoomList', 'AddRoomList')->name('add.roomlist'); 
        Route::post('/Store/RoomList', 'StoreRoomList')->name('store.roomlist'); 

    });


    
    Route::controller(SettingController::class)->group(function(){
        //smtp setting
        Route::get('/smtp/setting', 'SmtpSetting')->name('smtp.setting');
        Route::post('/smtp/update', 'SmtpUpdate')->name('smtp.update');
        //site setting
        Route::get('/site/setting', 'SiteSetting')->name('site.setting');
        Route::post('/site/update', 'SiteUpdate')->name('site.update');

    });

    Route::controller(TestimonialController::class)->group(function(){

        Route::get('/all/testimonial', 'AllTestimonial')->name('all.testimonial'); 
        Route::get('/add/testimonial', 'AddTestimonial')->name('add.testimonial'); 
        Route::post('/store/testimonial', 'StoreTestimonial')->name('testimonial.store'); 
        Route::get('/edit/testimonial/{id}', 'EditTestimonial')->name('edit.testimonial');
        Route::post('/update/testimonial', 'UpdateTestimonial')->name('testimonial.update'); 
        Route::get('/delete/testimonial/{id}', 'DeleteTestimonial')->name('delete.testimonial');
    });

    Route::controller(ReportController::class)->group(function(){

        Route::get('/Booking/Report', 'BookingReport')->name('booking.report');
        Route::post('/Booking/Search', 'BookingSearch')->name('search.by.date');
    });

    Route::controller(GalleryController::class)->group(function(){

        Route::get('/All/Gallery', 'AllGallery')->name('all.gallery');
        Route::get('/add/gallery', 'AddGallery')->name('add.gallery');
        Route::post('/store/gallery', 'StoreGallery')->name('store.gallery'); 
        Route::get('/edit/gallery/{id}', 'EditGallery')->name('edit.gallery');
        Route::post('/update/gallery', 'UpdateGallery')->name('update.gallery');
        Route::get('/delete/gallery/{id}', 'DeleteGallery')->name('delete.gallery');
        Route::post('/delete/gallery/multiple', 'DeleteGalleryMultiple')->name('delete.gallery.multiple');

    });

    Route::controller(ContactController::class)->group(function(){
        Route::get('/show/contacts', 'ShowContact')->name('show.contact');
    });



});


// end middleware admin 

Route::controller(FrontendRoomController::class)->group(function(){
    Route::get('/rooms', 'FrontendRoomList')->name('frontend.all.rooms');
    Route::get('/room/details/{id}', 'RoomDetailsPage');

});

Route::controller(BookingController::class)->group(function(){
    Route::get('/bookings', 'BookingSearch')->name('booking.search');
    Route::get('/bookings/room/detail/{id}', 'BookingRoomDetails')->name('search_room_details');
    Route::get('/check_room_availability', 'CheckRoomAvailability')->name('check_room_availability');
});

Route::middleware('auth')->group(function () {

    Route::controller(BookingController::class)->group(function(){
        Route::get('/checkout', 'Checkout')->name('checkout');
        Route::post('/user/booking/store', 'BookingStore')->name('user_booking_store');
        Route::post('/user/checkoutstore', 'CheckoutStore')->name('checkout.store');
        Route::match(['get', 'post'],'/stripe_pay', [BookingController::class, 'stripe_pay'])->name('stripe_pay');
        Route::get('/user/bookings', 'UserBooking')->name('user.bookings');
        Route::get('/user/invoice/{id}', 'UserInvoice')->name('user.invoice');

    });

});

Route::controller(GalleryController::class)->group(function(){
    Route::get('/Gallery', 'ShowGallery')->name('show.gallery');
});


Route::controller(ContactController::class)->group(function(){
    Route::get('/contact', 'ContactUs')->name('contact.us');
    Route::post('/store/contact', 'StoreContactUs')->name('store.contact');
});

Route::controller(BookingController::class)->group(function(){
    Route::post('/mark-notification-as-read/{notification}', 'MarkAsRead');
});