<?php

use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CreateSuperAdmin;
use App\Http\Controllers\EnrollController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserVerificationController;
use App\Http\Controllers\WebAdmin\DashboardController;
use App\Http\Controllers\WebAdmin\LoginController;
use App\Http\Controllers\WebAdmin\InvoicesController as WebAdminInvoicesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
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

Route::controller(CreateSuperAdmin::class)->middleware('guest')->group(function () {
    Route::get('/create-root', 'index')->name('create.root');
    Route::any('/create-superadmin', 'store')->name('create.superadmin');
});

Route::get('/change-language', function (Request $request) {
    if ($request->language) {
        App::setLocale($request->language);
        session()->put('locale', $request->language);
    }

    return back();
})->name('change.language');

Route::get('/organization', function () {
    return to_route('org.dashboard');
});


Route::middleware(['auth:web', 'verication_guard'])->group(function () {
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard')->middleware('permission:home.dashboard')->middleware('url_guard');
    Route::get('/instructor/dashboard', [DashboardController::class, 'instructorHome'])->name('instructor.dashboard');
});

Route::prefix('/admin')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('admin.login');
    Route::get('/register', [LoginController::class, 'instructorRegister'])->name('instructor.register');
    Route::post('/register', [LoginController::class, 'instructorAuthenticate'])->name('instructor.authenticate');
    Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('admin.authenticate');
    Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout')->middleware(['auth:web']);
    Route::get('/email/verify', [UserVerificationController::class, 'index'])->name('verification.index')->middleware('auth:web');
    Route::get('/{email}/resend/otp', [UserVerificationController::class, 'sendotp'])->name('verification.resend.otp');
    Route::post('/email/{email}/verify', [UserVerificationController::class, 'verify'])->name('verification.verify');
});

Route::get('/payment/{identifier}', [EnrollController::class, 'paymentView'])->name('payment');

// Paypal
Route::get('paypal/payment/success/{identifier}', [PaymentController::class, 'paypalPaymentSuccess'])->name('paypal.payment.success');
Route::get('paypal/payment/cancel', [PaymentController::class, 'paypalPaymentCancel'])->name('paypal.payment.cancel');

// Stripe
Route::get('stripe/payment/success/{identifier}', [PaymentController::class, 'stripePaymentSuccess'])->name('stripe.payment.success');
Route::get('stripe/payment/cancel', [PaymentController::class, 'stripePaymentCancel'])->name('stripe.payment.cancel');

// AamarPay
Route::post('aamarpay/payment/success', [PaymentController::class, 'aamarpayPaymentSuccess'])->name('aamrpay.payment.success');
Route::post('aamarpay/payment/fail', [PaymentController::class, 'aamarpayPaymentFail'])->name('aamrpay.payment.fail');
Route::get('aamarpay/payment/cancel', [PaymentController::class, 'aamarpayPaymentCancel'])->name('aamrpay.payment.cancel');


// razorpay
Route::get('razorpay/payment/success/{identifier}', [PaymentController::class, 'razorPaySuccess'])->name('razorpay.payment.success');
Route::get('razorpay/payment/fail', [PaymentController::class, 'razorpayPaymentFail'])->name('razorpay.payment.fail');

// Paymob
// Route::get('paymob/payment/success/{identifier}', [PaymentController::class, 'paymobPaymentSuccess'])->name('paymob.payment.success');
// Route::get('paymob/payment/fail', [PaymentController::class, 'paymobPaymentFail'])->name('paymob.payment.fail');
// Route::get('paymob/payment/cancel', [PaymentController::class, 'paymobPaymentCancel'])->name('paymob.payment.cancel');

Route::get('/download_app', [MasterController::class, 'checkDeviceAndRedirect'])->name('download_app');

// downloadable certificate url
Route::controller(CertificateController::class)->group(function () {
    Route::get('/download/certificate/{incodeData}', 'downloadCertificate')->name('download.certificate');
    Route::get('/show/certificate/{course}/{user}', 'ShowCertificate')->name('show.certificate');
});

Route::controller(WebAdminInvoicesController::class)->name('invoice.')->prefix('invoice')->group(function () {
    Route::get('/v/{invoice_token}', 'invoiceVerify')->name('verify');
    Route::get('/download/{invoice_token}', 'invoiceDownload')->name('download');
});

Route::get('/cache/clear', function () {
    try {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
    } catch (\Exception $e) {
        return back()->withError($e->getMessage());
    }
    return redirect()->back()->withSuccess('Cache cleared successfully.');
})->name('cache.clear');

Route::middleware('org_plan_expire_route_guard')->get("/org-expired", function () {
    return view('errors.plan-expired');
})->name('org.plan.expired');

// this is proxy url
// Route::get('/', fn() => view('comingsoon'))->name('website');

Route::get('/{any}', function () {
    return view('website');
})->where('any', '^(?!admin/*|organization/*).*');
