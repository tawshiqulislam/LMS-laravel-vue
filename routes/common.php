<?php

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\WebAdmin\AdminOrgManagementController;
use App\Http\Controllers\WebAdmin\BannerController;
use App\Http\Controllers\WebAdmin\CategoryController;
use App\Http\Controllers\WebAdmin\ChapterController;
use App\Http\Controllers\WebAdmin\ContactController;
use App\Http\Controllers\WebAdmin\CouponController;
use App\Http\Controllers\WebAdmin\CourseController;
use App\Http\Controllers\WebAdmin\CustomNotificationController;
use App\Http\Controllers\WebAdmin\EnrollmentController;
use App\Http\Controllers\WebAdmin\ExamController;
use App\Http\Controllers\WebAdmin\InstructorController;
use App\Http\Controllers\WebAdmin\InvoicesController as WebAdminInvoicesController;
use App\Http\Controllers\WebAdmin\ManageCertificateController;
use App\Http\Controllers\WebAdmin\NewslatterController;
use App\Http\Controllers\WebAdmin\NotificationController;
use App\Http\Controllers\WebAdmin\PageController;
use App\Http\Controllers\WebAdmin\PaymentGatewayController;
use App\Http\Controllers\WebAdmin\PlanController;
use App\Http\Controllers\WebAdmin\ProfileController;
use App\Http\Controllers\WebAdmin\QuizController;
use App\Http\Controllers\WebAdmin\ReportController;
use App\Http\Controllers\WebAdmin\ReviewController;
use App\Http\Controllers\WebAdmin\ServerConfigurationController;
use App\Http\Controllers\WebAdmin\SettingController;
use App\Http\Controllers\WebAdmin\StorageLinkController;
use App\Http\Controllers\WebAdmin\SubscribersController;
use App\Http\Controllers\WebAdmin\TestimonialController;
use App\Http\Controllers\WebAdmin\TransactionController;
use App\Http\Controllers\WebAdmin\UserController;
use App\Http\Controllers\WebAdmin\UserRoleController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:web', 'verication_guard'])->group(function () {
    // Route::prefix('/admin')->group(function () {
    // Route::get('/dashboard', [DashboardController::class, 'instructorHome'])->name('instructor.dashboard');
    // Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard')->middleware('permission:home.dashboard')->middleware('url_guard');
    Route::get('/root/sup-admin/list', [UserController::class, 'admin'])->name('admin.index');
    Route::get('/root/assistant-admin/list', [UserController::class, 'subAdmin'])->name('admin.assistant.index');

    // profile section
    Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile')->middleware('permission:admin.profile');
    Route::put('/profile/image/update/{user}', [ProfileController::class, 'profileImageUpdate'])->name('admin.profile.image.update')->middleware('permission:admin.profile.image.update');

    // report section
    Route::controller(ReportController::class)->prefix('/report')->group(function () {
        Route::get('/list', 'index')->name('report.index')->middleware('permission:report.index');
        Route::get('/filter', 'filter')->name('report.filter')->middleware('permission:report.filter');
        Route::get('/generate/pdf', 'generatepdf')->name('report.generate.pdf')->middleware('permission:report.generate.pdf');
        Route::get('/exportCSV', 'exportCSV')->name('report.exportCSV')->middleware('permission:report.exportCSV');
    });

    // contact section
    Route::middleware('org_check')->controller(ContactController::class)->prefix('/contact')->group(function () {
        Route::get('/list', 'index')->name('contact.index')->middleware('permission:contact.index');
        Route::get('/show/{contact}', 'show')->name('contact.show')->middleware('permission:contact.index');
        Route::get('/delete/{contact}', 'delete')->name('contact.destroy')->middleware('permission:contact.destroy');
    });

    Route::controller(CategoryController::class)->prefix('category')->group(function () {
        Route::get('/list', 'index')->name('category.index')->middleware('permission:category.index');
        Route::get('/create', 'create')->name('category.create')->middleware('permission:category.create');
        Route::post('/store', 'store')->name('category.store')->middleware('permission:category.store');
        Route::post('/sort', 'sort')->name('category.sort');
        Route::get('/edit/{category}', 'edit')->name('category.edit')->middleware('permission:category.edit');
        Route::put('/update/{category}', 'update')->name('category.update')->middleware(['permission:category.update', 'access_guard']);
        Route::get('/delete/{category}', 'delete')->name('category.destroy')->middleware(['permission:category.destroy', 'access_guard']);
        Route::get('/restore/{id}', 'restore')->name('category.restore')->middleware('permission:category.restore');
    });

    Route::middleware('org_check')->controller(CourseController::class)->prefix('course')->group(function () {
        Route::get('/list', 'index')->name('course.index')->middleware('permission:course.index');
        Route::get('/create', 'create')->name('course.create')->middleware('permission:course.create');
        Route::get('/show/{course}', 'show')->name('course.show')->middleware('permission:course.show');
        Route::post('/store', 'store')->name('course.store')->middleware('permission:course.store');
        Route::get('/edit/{course}', 'edit')->name('course.edit')->middleware('permission:course.edit');
        Route::post('/update/{course}', 'update')->name('course.update')->middleware(['permission:course.update', 'access_guard']);
        Route::get('/delete/{course}', 'delete')->name('course.destroy')->middleware(['permission:course.destroy', 'access_guard']);
        Route::get('/restore/list', 'restoreCourse')->name('course.restore.list')->middleware('permission:course.restore_course');
        Route::get('/restore/{id}', 'restore')->name('course.restore')->middleware('permission:course.restore');
        Route::get('/free/{course}', 'freeCourse')->name('course.free')->middleware('permission:course.free');
    });

    Route::controller(ChapterController::class)->prefix('chapter')->group(function () {
        Route::get('/select_course', 'selectCourse')->name('chapter.select_course')->middleware('permission:chapter.select_course');
        Route::get('/list/{course}', 'index')->name('chapter.index')->middleware('permission:chapter.index');
        Route::get('/create/{course}', 'create')->name('chapter.create')->middleware('permission:chapter.create');
        Route::post('/store', 'store')->name('chapter.store')->middleware('permission:chapter.store');
        Route::get('/edit/{chapter}', 'edit')->name('chapter.edit')->middleware('permission:chapter.edit');
        Route::post('/update/{chapter}', 'update')->name('chapter.update')->middleware(['permission:chapter.update', 'access_guard']);
        Route::get('/delete/{chapter}', 'delete')->name('chapter.destroy')->middleware(['permission:chapter.destroy', 'access_guard']);
    });

    Route::controller(ExamController::class)->prefix('exam')->group(function () {
        Route::get('/select_course', 'selectCourse')->name('exam.select_course')->middleware('permission:exam.select_course');
        Route::get('/list/{course}', 'index')->name('exam.index')->middleware('permission:exam.index');
        Route::get('/create/{course}', 'create')->name('exam.create')->middleware('permission:exam.create');
        Route::post('/store', 'store')->name('exam.store')->middleware('permission:exam.store');
        Route::get('/edit/{exam}', 'edit')->name('exam.edit')->middleware('permission:exam.edit');
        Route::put('/update/{exam}', 'update')->name('exam.update')->middleware('permission:exam.update');
        Route::get('/delete/{exam}', 'delete')->name('exam.destroy')->middleware('permission:exam.destroy');
    });

    Route::controller(QuizController::class)->prefix('quiz')->group(function () {
        Route::get('/select_course', 'selectCourse')->name('quiz.select_course')->middleware('permission:quiz.select_course');
        Route::get('/list/{course}', 'index')->name('quiz.index')->middleware('permission:quiz.index');
        Route::get('/create/{course}', 'create')->name('quiz.create')->middleware('permission:quiz.create');
        Route::post('/store', 'store')->name('quiz.store')->middleware('permission:quiz.store');
        Route::get('/edit/{quiz}', 'edit')->name('quiz.edit')->middleware('permission:quiz.edit');
        Route::put('/update/{quiz}', 'update')->name('quiz.update')->middleware('permission:quiz.update');
        Route::get('/delete/{quiz}', 'delete')->name('quiz.destroy')->middleware('permission:quiz.destroy');
    });

    Route::controller(CouponController::class)->prefix('coupon')->group(function () {
        Route::get('/list', 'index')->name('coupon.index')->middleware('permission:coupon.index');
        Route::get('/create', 'create')->name('coupon.create')->middleware('permission:coupon.create');
        Route::post('/store', 'store')->name('coupon.store')->middleware('permission:coupon.store');
        Route::get('/edit/{coupon}', 'edit')->name('coupon.edit')->middleware('permission:coupon.edit');
        Route::put('/update/{coupon}', 'update')->name('coupon.update')->middleware('permission:coupon.update');
        Route::get('/delete/{coupon}', 'delete')->name('coupon.destroy')->middleware('permission:coupon.destroy');
    });

    Route::controller(EnrollmentController::class)->name('enrollment.')->prefix('enrollment')->group(function () {
        Route::get('/list', 'index')->name('index')->middleware('permission:enrollment.index');
        Route::get('/delete/{enrollment}', 'delete')->name('destroy')->middleware('permission:enrollment.destroy');
        Route::get('/suspended/{enrollment}', 'suspended')->name('suspended')->middleware('permission:enrollment.suspended');
        Route::get('/restore/{id}', 'restore')->name('restore')->middleware('permission:enrollment.restore');
        Route::post('/certificate-name-update/{enrollment}', 'nameUpdate')->name('enrollment.update_certificate_name')->middleware('permission:enrollment.update_certificate_name');
        Route::get('/generate/pdf', 'generatepdf')->name('generate.pdf')->middleware('permission:enrollment.generate.pdf');
        Route::get('/exportCSV', 'exportCSV')->name('exportCSV')->middleware('permission:enrollment.exportCSV');
    });

    Route::controller(ReviewController::class)->prefix('review')->group(function () {
        Route::get('/list', 'index')->name('review.index')->middleware('permission:review.index');
        Route::get('/delete/{review}', 'delete')->name('review.destroy')->middleware('permission:review.destroy');
    });

    Route::controller(InstructorController::class)->prefix('instructor')->group(function () {
        Route::get('/list', 'index')->name('instructor.index')->middleware('permission:instructor.index');
        Route::get('/featured', 'featured')->name('instructor.featured')->middleware('permission:instructor.featured');
        Route::get('/promote/{user}', 'promote')->name('instructor.promote')->middleware('permission:instructor.promote');
        Route::post('/migrate/{user}', 'migrate')->name('instructor.migrate')->middleware('permission:instructor.migrate');
        Route::get('/create', 'create')->name('instructor.create')->middleware('permission:instructor.create');
        Route::post('/store', 'store')->name('instructor.store')->middleware('permission:instructor.store');
        Route::get('/edit/{instructor}', 'edit')->name('instructor.edit')->middleware('permission:instructor.edit');
        Route::put('/update/{instructor}', 'update')->name('instructor.update')->middleware(['permission:instructor.update', 'access_guard']);
        Route::get('/delete/{instructor}', 'delete')->name('instructor.destroy')->middleware(['permission:instructor.destroy', 'access_guard']);
        Route::get('/restore/{id}', 'restore')->name('instructor.restore')->middleware('permission:instructor.restore');
    });

    Route::controller(TransactionController::class)->prefix('transaction')->group(function () {
        Route::get('/total/transaction', 'index')->name('transaction.index')->middleware('permission:transaction.index');
        Route::get('/total/failed/transaction', 'failedTransaction')->name('transaction.failed')->middleware('permission:transaction.failed');
        Route::get('/course/wise/transaction', 'courseWiseTransaction')->name('transaction.courses')->middleware('permission:transaction.courses');
        Route::get('/invoice/wise/transaction', 'invoiceWiseTransaction')->name('transaction.invoices')->middleware('permission:transaction.invoices');
        Route::get('/subscription/wise/transaction', 'subscriptionWiseTransaction')->name('transaction.subscriptions')->middleware('permission:transaction.subscriptions');
        Route::get('/dns/wise/transaction', 'dnsWiseTransaction')->name('transaction.dns.plans')->middleware('permission:transaction.dns.plans');
    });

    Route::middleware('org_check')->controller(UserController::class)->prefix('user')->group(function () {
        Route::get('/list', 'index')->name('user.index')->middleware('permission:user.index');
        Route::get('/create', 'create')->name('user.create')->middleware('permission:user.create');
        Route::post('/store', 'store')->name('user.store')->middleware('permission:user.store');
        Route::get('/edit/{user}', 'edit')->name('user.edit')->middleware('permission:user.edit');
        Route::put('/update/{user}', 'update')->name('user.update')->middleware(['permission:user.update', 'access_guard']);
        Route::get('/delete/{user}', 'delete')->name('user.destroy')->middleware(['permission:user.destroy', 'access_guard']);
        Route::get('/restore/{id}', 'restore')->name('user.restore')->middleware('permission:user.restore');
    });

    Route::middleware('org_check')->controller(PageController::class)->prefix('page')->group(function () {
        Route::get('/list', 'index')->name('page.index')->middleware('permission:page.index');
        Route::get('/edit/{slug}', 'edit')->name('page.edit')->middleware('permission:page.edit');
        Route::put('/update/{slug}', 'update')->name('page.update')->middleware('permission:page.update');
    });

    Route::controller(SettingController::class)->prefix('setting')->group(function () {
        Route::get('/', 'index')->name('setting.index')->middleware('permission:setting.index');
        Route::get('/home-page/settings', 'homePageSetup')->name('setting.home.page.setup')->middleware('permission:setting.index');
        Route::get('/smtp/settings', 'smtpSetup')->name('setting.smtp.setup')->middleware('permission:setting.index');
        Route::get('/social-media/settings', 'socialMediaSetup')->name('setting.social.media.setup')->middleware('permission:setting.index');
        Route::put('/update', 'update')->name('setting.update')->middleware(['permission:setting.update', 'access_guard']);
    });

    Route::controller(PaymentGatewayController::class)->prefix('payment_gateway')->group(function () {
        Route::get('/', 'index')->name('payment_gateway.index')->middleware('permission:payment_gateway.index');
        Route::put('/update/{paymentGateway}', 'update')->name('payment_gateway.update')->middleware('permission:payment_gateway.update');
    });

    Route::controller(NotificationController::class)->prefix('notification')->group(function () {
        Route::get('/list', 'index')->name('notification.index')->middleware('permission:notification.index');
        Route::get('/read/{notificationInstance}', 'markAsRead')->name('notification.read');
        Route::get('/read-all', 'markAsReadAll')->name('notification.read.all');
        Route::get('/edit/{notification}', 'edit')->name('notification.edit')->middleware('permission:notification.edit');
        Route::get('/switch/{notification}/status', 'switchStatus')->name('notification.switch.status')->middleware('permission:notification.switch.status');
        Route::put('/update/{notification}', 'update')->name('notification.update')->middleware('permission:notification.update');

        Route::controller(CustomNotificationController::class)->prefix('/custom')->group(function () {
            Route::get('/list', 'index')->name('notification.custom.index')->middleware('permission:notification.custom.index');
            Route::post('/send/message', 'sendMessage')->name('notification.custom.send.message')->middleware(['permission:notification.custom.send.message', 'access_guard']);
        });
    });

    Route::controller(UserRoleController::class)->prefix('permission&role')->group(function () {
        Route::get('/list', 'index')->name('role.index')->middleware('permission:role.index');
        Route::get('/create', 'create')->name('role.create')->middleware('permission:role.create');
        Route::get('/delete/{role}', 'delete')->name('role.delete')->middleware('permission:role.delete');
        Route::get('/get/permission/{role}', 'getPermission')->name('role.get_permission')->middleware('permission:role.get_permission');
        Route::post('/store', 'store')->name('role.store')->middleware('permission:role.store');
        Route::post('/update/{role}', 'update')->name('role.update')->middleware('permission:role.update');
        Route::post('/assign/roletopermission/{role}', 'assignRoleToPermission')->name('role.assign_roletopermission')->middleware('permission:role.assign_roletopermission');
        Route::post('/assign/roletouser/{user}', 'assignRoleToUser')->name('role.assign_roletouser')->middleware('permission:role.assign_roletouser');
        Route::get('/dispatchRole/{user}/{role}', 'removeRoleFromUser')->name('role.dispatchRole')->middleware('permission:role.dispatchRole');
    });

    Route::controller(TestimonialController::class)->prefix('testimonial')->group(function () {
        Route::get('/list', 'index')->name('testimonial.index')->middleware('permission:testimonial.index');
        Route::get('/create', 'create')->name('testimonial.create')->middleware('permission:testimonial.create');
        Route::post('/store', 'store')->name('testimonial.store')->middleware('permission:testimonial.store');
        Route::get('/edit/{testimonial}', 'edit')->name('testimonial.edit')->middleware('permission:testimonial.edit');
        Route::put('/update/{testimonial}', 'update')->name('testimonial.update')->middleware(['permission:testimonial.update', 'access_guard']);
        Route::get('/delete/{testimonial}', 'destroy')->name('testimonial.destroy')->middleware(['permission:testimonial.destroy', 'access_guard']);
        Route::get('/restore/{testimonial}', 'restore')->name('testimonial.restore')->middleware('permission:testimonial.restore');
    });

    Route::middleware('org_check')->controller(ManageCertificateController::class)->prefix('certificate')->group(function () {
        Route::get('/list', 'index')->name('certificate.index')->middleware('permission:certificate.index');
        Route::post('/update', 'update')->name('certificate.update')->middleware(['permission:certificate.update', 'access_guard']);
        Route::get('/delete/{frame}', 'delete')->name('certificate.delete')->middleware('permission:certificate.delete');
    });

    Route::controller(NewslatterController::class)->prefix('newslatter')->name('newslatter.')->group(function () {
        Route::get('/list', 'index')->name('index')->middleware('permission:newslatter.index');
        Route::get('/delete/{id}', 'delete')->name('delete')->middleware('permission:newslatter.delete');
        Route::get('/restore/{id}', 'restore')->name('restore')->middleware('permission:newslatter.restore');
        Route::get('/send/mail/{id}', 'sendMail')->name('send.mail')->middleware('permission:newslatter.send.mail');
    });

    Route::controller(LanguageController::class)->prefix('language')->name('language.')->group(function () {
        Route::get('/list', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{language}', 'edit')->name('edit');
        Route::put('/update/{language}', 'update')->name('update');
        Route::get('/delete/{language}', 'delete')->name('delete');
        Route::post('/export/{language}', 'export')->name('export');
        Route::post('/import/{language}', 'import')->name('import');
        Route::get('/default/{language}/language', 'setDefaultLanguage')->name('default');
    });


    Route::controller(WebAdminInvoicesController::class)->name('invoice.')->prefix('invoices')->group(function () {
        Route::get('/list', 'index')->name('index')->middleware('permission:invoice.index');
        Route::get('/list/restore', 'restoreTrash')->name('trash')->middleware('permission:invoice.trash');
        Route::get('/create', 'create')->name('create')->middleware('permission:invoice.create');
        Route::post('/store', 'store')->name('store')->middleware('permission:invoice.store');
        Route::get('/edit/{invoice}', 'edit')->name('edit')->middleware('permission:invoice.edit');
        Route::post('/update/{invoice}', 'update')->name('update')->middleware('permission:invoice.update');
        Route::get('/delete/{id}', 'delete')->name('delete')->middleware('permission:invoice.delete');
        Route::get('/restore/{id}', 'restore')->name('restore')->middleware('permission:invoice.restore');
    });

    Route::middleware('org_check')->controller(BannerController::class)->name('banner.')->prefix('banners')->group(function () {
        Route::get('/list', 'index')->name('index')->middleware('permission:banner.index');
        Route::post('/store', 'store')->name('store')->middleware('permission:banner.store');
        Route::post('/update/{id}', 'update')->name('update')->middleware('permission:banner.update');
        Route::get('/delete/{id}', 'delete')->name('delete')->middleware('permission:banner.delete');
        Route::post('/banner-publish', 'publish')->name('publish')->middleware('permission:banner.publish');
    });

    Route::controller(PlanController::class)->name('plan.')->prefix('plans')->group(function () {
        Route::get('/list', 'index')->name('index')->middleware('permission:plan.index');
        Route::get('/create', 'create')->name('create')->middleware('permission:plan.create');
        Route::post('/store', 'store')->name('store')->middleware('permission:plan.store');
        Route::get('/edit/{plan}', 'edit')->name('edit')->middleware('permission:plan.edit');
        Route::post('/update/{plan}', 'update')->name('update')->middleware(['permission:plan.update', 'access_guard']);
        Route::get('/delete/{plan}', 'delete')->name('delete')->middleware(['permission:plan.delete', 'access_guard']);
        Route::get('/trashes', 'trash')->name('trash')->middleware('permission:plan.trash');
        Route::get('/restore/{id}', 'restore')->name('restore')->middleware('permission:plan.restore');
        Route::post('/publish', 'publish')->name('publish')->middleware('permission:plan.publish');
    });

    Route::controller(SubscribersController::class)->name('subscriber.')->prefix('subscribers')->group(function () {
        Route::get('/list', 'index')->name('index')->middleware('permission:subscriber.index');
    });

    Route::controller(ServerConfigurationController::class)->name('server.')->prefix('servers')->group(function () {
        Route::get('/list', 'index')->name('index')->middleware('permission:server.index');
        Route::post('/store', 'store')->name('store')->middleware('permission:server.store');
    });

    Route::controller(AdminOrgManagementController::class)->name('organizations.')->prefix('organizations')->group(function () {
        Route::get('/list', 'index')->name('index')->middleware('permission:organizations.index');
        Route::get('/edit/{id}', 'edit')->name('edit')->middleware('permission:organizations.edit');
        Route::get('/subscribers', 'subscribers')->name('subscribers')->middleware('permission:organizations.subscribers');
        Route::name('plan.')->prefix('plan')->group(function () {
            Route::get('/list', 'planIndex')->name('index')->middleware('permission:organizations.plan.index');
            Route::get('/create', 'planCreate')->name('create')->middleware('permission:organizations.plan.create');
            Route::post('/store', 'planStore')->name('store')->middleware('permission:organizations.plan.store');
            Route::get('/edit/{id}', 'planEdit')->name('edit')->middleware('permission:organizations.plan.edit');
            Route::post('/update/{id}', 'planUpdate')->name('update')->middleware('permission:organizations.plan.update');
        });
    });



    Route::get('/link/storage', [StorageLinkController::class, 'linkStorage'])->name('link.storage')->middleware('permission:storage.link.storage');
});
