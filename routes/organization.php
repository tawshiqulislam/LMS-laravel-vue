<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Org\Auth\RegisterController;
use App\Http\Controllers\Org\DnsConfigController;
use App\Http\Controllers\Org\Home\HomeController;
use App\Http\Controllers\Org\OrganizationSiteSettingsController;
use App\Http\Controllers\Org\OrgDnsPricingController;
use App\Http\Controllers\Org\PlanManagementController;
use App\Http\Controllers\WebAdmin\CourseController;
use App\Http\Controllers\WebAdmin\UserController;

/*
|--------------------------------------------------------------------------
| Organization Routes
|--------------------------------------------------------------------------
|
| Here is where you can register organization routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "org" middleware group. Make something great!
|
*/


// Organization Routes

// Organization Authentication
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/authenticate', [RegisterController::class, 'authenticate'])->name('authentication');

// Organization home

Route::middleware(['auth:web', 'verication_guard'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard')->middleware(['org_check']);
    Route::get('/profile/{user}', [HomeController::class, 'profile'])->name('profile');
    Route::get('/chart/revenue-data', [HomeController::class, 'revenue'])->middleware('org_check');
    // Organization DNS Management
    Route::middleware(['org_plan_expire'])->controller(DnsConfigController::class)->name('dns.')->group(function () {
        Route::get('/dns', 'index')->name('index');
        Route::post('/dns', 'store')->name('store');
    });
    // Organization settings Management
    Route::controller(OrganizationSiteSettingsController::class)->prefix('site/settings')->name('site.')->group(function () {
        Route::get('/settings', 'index')->name('setting.index');
        Route::post('/store', 'store')->name('setting.store');
    });
    // Organization DNS Pricing
    Route::controller(OrgDnsPricingController::class)->name('pricing.')->prefix('pricing')->group(function () {
        Route::get('/plans', 'index')->name('index');
        Route::post('/payment/initiate/{plan}', 'paymentInitiate')->name('payment.initiate');
    });

    // Organization DNS Pricing
    Route::controller(PlanManagementController::class)->name('plan.')->prefix('plan')->group(function () {
        Route::get('/my/current-plan', 'index')->name('index');
        Route::get('/transaction/history', 'billingHistory')->name('billing.history');
    });



    // Organization User Management
    // Route::controller(UserController::class)->prefix('user')->group(function () {
    //     Route::get('/list', 'index')->name('user.index');
    //     Route::get('/create', 'create')->name('user.create');
    //     Route::post('/store', 'store')->name('user.store');
    //     Route::get('/edit/{user}', 'edit')->name('user.edit');
    //     Route::put('/update/{user}', 'update')->name('user.update');
    //     Route::get('/delete/{user}', 'delete')->name('user.destroy');
    //     Route::get('/restore/{id}', 'restore')->name('user.restore');
    // });
});
