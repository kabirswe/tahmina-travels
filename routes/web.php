<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\PaymentTypeController;
use App\Http\Controllers\TicketController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Auth::routes(['register' => false]);

Route::get('/', [HomeController::class, 'index'])->name('home');

// Auth routes

// Admin routes
Route::get('/', [LoginController::class, 'showLoginForm']);
// Route::group(['middleware' => ['auth', 'checkActiveUser'], ['role:admin|operator|seller|buyer']], function () {
Route::group(['middleware' => ['auth'], ['role:admin']], function () {
    // User management resources
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    // User management resources
    Route::resource('roles', RoleController::class);
    // Route::get('role/permission/create', 'RoleController@permissionCreate')->name('role.permission.create');
    // Route::post('role/permission/store', 'RoleController@permissionStore')->name('role.permission.store');

    Route::resource('users', UserController::class);
    Route::get('users/change/status', [UserController::class, 'changeStatus']);

    Route::get('block/user/list', [LoginController::class, 'blockedUserList'])->name('blockedUserList');
    Route::any('unblock/user', [LoginController::class, 'unblockUser'])->name('unblock.user');

    Route::get('user/logs',  [UserController::class, 'userLogs'])->name('user.logs');
    Route::get('user/log/show', [UserController::class, 'userLogShow'])->name('user.log.show');
    Route::get('user/log/delete', [UserController::class, 'userLogDestroy'])->name('user.log.destroy');

    // Place
    Route::resource('place', PlaceController::class);
    // Payment Type
    Route::resource('payment/type', PaymentTypeController::class, ['as' => 'payment']);
    // Ticket
    Route::resource('ticket', TicketController::class);
    Route::get('ticket/get/user/{id}', [TicketController::class, 'get_user'])->name('ticket.get.user');
});
