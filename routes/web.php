<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', function () {  return view('welcome');  });


Auth::routes();

//Auth::routes(['register'=>false]);

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
], function () {



//  for get home page in dashboard
Route::get('/home', 'Dashboard\HomeController@index')->name('home');



//   ==============================================================================
//   ================             Users               =============================
//   ==============================================================================
   // for control in users in dashboard
   Route::resource('Users', 'Dashboard\UserController');
    // for change status for user
   Route::get('activate/{id}','Dashboard\UserController@activate')->name('Users.activate');

   // for get profile page in dashboard
    Route::get('/profile' , 'Dashboard\UserController@getProfile')->name('getProfile');
    // for update profile user in dashboard
    Route::post('/profile' , 'Dashboard\UserController@updateProfile')->name('updateProfile');
    // for get reset password page in dashboard
    Route::get('/resetPassword' , 'Dashboard\UserController@resetPassword')->name('resetPassword');
    // for update password
    Route::post('updatePassword', 'Dashboard\UserController@updatePassword')->name('updatePassword');




//   ==============================================================================




//   ==============================================================================
//   ================            Notifications        =============================
//   ==============================================================================
    // for get PushNotification Page in dashboard
    Route::get('/pushNotification' , 'Dashboard\PushNotificationController@index')->name('pushNotification');

    Route::post('/pushNotification' , 'Dashboard\PushNotificationController@pushNotification')->name('pushNotification');
    // for read 1 notification for user
    Route::get('readNotification/{id}', 'Dashboard\PushNotificationController@readNotification');
    // for read all notifications for user
    Route::get('markallasread',function(){  Auth::user()->unreadNotifications->markAsRead(); return redirect()->back();  })->name('markallasread');



//   ==============================================================================




 //   ==============================================================================
//   ================            Roles & Permissions        =======================
//   ==============================================================================
    // for control Role in dashboard
    Route::resource('Roles' , 'Dashboard\RoleController');
    // for get Permissions Page in dashboard
    Route::get('/permissions' , 'Dashboard\RoleController@permissions')->name('permissions');


//   ==============================================================================





//   ==============================================================================
//   ================            Others                     =======================
//   ==============================================================================
    // for get log viewer page from Laravel
    Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index'])->name('logs');
    // for get setting page in dashboard
    Route::get('/setting' , 'Dashboard\HomeController@setting')->name('setting');


//   ==============================================================================





//   ==============================================================================

//   ==============================================================================
//   ================            HRMS                     =======================
//   ==============================================================================


    Route::resource('Departments' , 'Dashboard\DepartmentController');
    Route::resource('Designations' , 'Dashboard\DesignationController');


//   ==============================================================================

});


