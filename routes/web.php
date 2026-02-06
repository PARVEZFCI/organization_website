<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeController;
use App\Http\Controllers\Admin\adminloginController;
use App\Http\Controllers\Admin\adminRegistrationController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\auth\UserController;
use App\Http\Controllers\Admin\EmployeeContoller;
use App\Http\Controllers\Admin\StudentProfile;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\EarningController;
use App\Http\Controllers\Admin\BorrowingBookController;
use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\TransferBatchController;
use App\Http\Controllers\Admin\UpdateuserController;
use App\Http\Controllers\Admin\HomeSettingController;
use App\Http\Controllers\Admin\AboutSettingController;
use App\Http\Controllers\Admin\CourseSetupController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\WhyChooseController;
use App\Http\Controllers\Admin\StudentVisaController;
use App\Http\Controllers\Admin\StudentReviewController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\OurServiceController;
use App\Http\Controllers\Admin\OngoingActivityController;
use App\Http\Controllers\Admin\PhotoGalleryController;
use App\Http\Controllers\Admin\UpcomingEventController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\PublicRegistrationController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\BkashPaymentController;


Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "Cache is cleared";
});
// Frontend homepage
Route::get('/', [homeController::class, 'home'])->name('home');

// About Section Routes
Route::get('/about', [homeController::class, 'about'])->name('about');
Route::get('/mission-vision', [homeController::class, 'missionVision'])->name('mission.vision');
Route::get('/aims-objectives', [homeController::class, 'aimsObjectives'])->name('aims.objectives');
Route::get('/constitution', [homeController::class, 'constitution'])->name('constitution');
Route::get('/message', [homeController::class, 'message'])->name('message');

// Content Section Routes
Route::get('/news', [homeController::class, 'news'])->name('news');
Route::get('/events', [homeController::class, 'events'])->name('events');
Route::get('/activities', [homeController::class, 'activities'])->name('activities');
Route::get('/gallery', [homeController::class, 'gallery'])->name('gallery');

// Committee Routes
Route::get('/executive-committee', [homeController::class, 'executiveCommittee'])->name('executive-committee');
Route::get('/advisory-council', [homeController::class, 'advisoryCouncil'])->name('advisory-council');

// Other Routes
Route::get('/contact', [homeController::class, 'contact'])->name('contact');
Route::get('/donation', [homeController::class, 'donation'])->name('donation.page');

// Membership form
Route::get('/membership', [App\Http\Controllers\MembershipController::class, 'create'])->name('membership.form');
Route::post('/membership', [App\Http\Controllers\MembershipController::class, 'store'])->name('membership.store');

// Public Registration Routes
Route::get('/register-account', [PublicRegistrationController::class, 'showRegistrationForm'])->name('public.registration.form');
Route::post('/register', [PublicRegistrationController::class, 'storeRegistration'])->name('public.registration.store');

// Newsletter Subscription
Route::post('/subscribe', [SubscriberController::class, 'subscribe'])->name('subscribe');

// bKash Payment Routes
Route::post('/bkash/create-payment', [BkashPaymentController::class, 'createPayment'])->name('bkash.create');
Route::get('/bkash/callback', [BkashPaymentController::class, 'callback'])->name('bkash.callback');
Route::get('/donation/success/{id}', [BkashPaymentController::class, 'success'])->name('donation.success');

// Admin login routes
Route::get('/login', [adminloginController::class, 'login'])->name('login');
Route::post('/admin_login_action', [adminloginController::class, 'admin_login_action'])->name('admin_login_action');
Route::get('/ragisterlogin', [adminRegistrationController::class, 'register'])->name('register');
Route::post('/ragisterloginaction', [adminRegistrationController::class, 'ragisterloginaction'])->name('ragisterloginaction');

Route::group(['middleware' => 'admin_auth', 'as' => 'Admin.', 'prefix' => 'admin'], function () {

    Route::get('qr-code-action', [homeController::class, 'generateQRCode'])->name('generate.qr.code');
    Route::get('qr-code-download', [homeController::class, 'downloadQRCode'])->name('qr-code-download');

    Route::get('/seminar-registrations', function () {
        $registrations = \App\Models\SeminarRegistration::all();
        return view('backend.seminar_registrations.index', compact('registrations'));
    })->name('seminar.registrations');

    Route::get('/deshboard', [homeController::class, 'deshboard'])->name('deshboard');
    Route::get('/home', [homeController::class, 'home'])->name('home');
    Route::get('/adminlogout', [homeController::class, 'adminlogout'])->name('adminlogout');

    Route::get('/branch', [homeController::class, 'branch'])->name('branch');
    Route::get('/addbranch', [homeController::class, 'addbranch'])->name('addbranch');
    Route::post('/storebranch', [homeController::class, 'storebranch'])->name('storebranch');
    Route::get('/editbranch/{id}', [homeController::class, 'editbranch'])->name('editbranch');

    Route::get('/changepassword', [UpdateuserController::class, 'changepassword'])->name('changepassword');
    Route::post('/updatepass', [UpdateuserController::class, 'updatepass'])->name('updatepass');
    //category Controller
    Route::get('/allcategory', [CategoryController::class, 'allcategory'])->name('allcategory');
    Route::get('/addcategory', [CategoryController::class, 'addcategory'])->name('addcategory');
    Route::post('/storecategory', [CategoryController::class, 'storecategory'])->name('storecategory');
    Route::get('/categorydlt/{id}', [CategoryController::class, 'categorydlt'])->name('categorydlt');
    Route::get('/editcategory/{id}', [CategoryController::class, 'editcategory'])->name('editcategory');
    Route::post('/updatecategory', [CategoryController::class, 'updatecategory'])->name('updatecategory');


    //Student Controller
    Route::get('/allstudent', [StudentController::class, 'allstudent'])->name('allstudent');
    Route::get('/addstudent', [StudentController::class, 'addstudent'])->name('addstudent');
    Route::post('/storestudent', [StudentController::class, 'storestudent'])->name('storestudent');
    Route::get('/deletestudent/{id}', [StudentController::class, 'destroy'])->name('deletestudent');
    Route::get('/course_details', [StudentController::class, 'course_details'])->name('course_details');
    Route::get('/studetails', [StudentController::class, 'studetails'])->name('studetails');
    Route::get('/studentid/{id}', [StudentController::class, 'studentid'])->name('studentid');
    Route::get('/studentform/{id}', [StudentController::class, 'studentform'])->name('studentform');

    Route::get('/deactivestu/{id}', [StudentController::class, 'deactivestu'])->name('deactivestu');
    Route::get('/activestu/{id}', [StudentController::class, 'activestu'])->name('activestu');
    Route::get('/studentedit/{id}', [StudentController::class, 'studentedit'])->name('studentedit');
    Route::post('/updatestudent', [StudentController::class, 'updatestudent'])->name('updatestudent');

    Route::get('/studenthomework', [StudentController::class, 'studenthomework'])->name('studenthomework');
    Route::post('/studentworkdetails', [StudentController::class, 'studentworkdetails'])->name('studentworkdetails');

    Route::get('/cat_details', [StudentController::class, 'cat_details'])->name('cat_details');

    Route::get('/todaydue', [StudentController::class, 'todaydue'])->name('todaydue');

    //settings
    Route::get('/settings', [homeController::class, 'settings'])->name('settings');
    Route::post('/storesettings', [homeController::class, 'storesettings'])->name('storesettings');



    //studentfee collection

    Route::get('/studentfee', [StudentController::class, 'studentfee'])->name('studentfee');
    Route::post('/storestupayment', [StudentController::class, 'storestupayment'])->name('storestupayment');
    Route::get('/studetailsforfee', [StudentController::class, 'studetailsforfee'])->name('studetailsforfee');

    //Student deshboard controller
    Route::get('/addwork', [StudentProfile::class, 'addwork'])->name('addwork');
    Route::post('/storework', [StudentProfile::class, 'storework'])->name('storework');
    Route::get('/studentprofile', [StudentProfile::class, 'studentprofile'])->name('studentprofile');
    Route::get('/allworkstudent', [StudentProfile::class, 'allworkstudent'])->name('allworkstudent');
    Route::get('/studentreport', [StudentProfile::class, 'studentreport'])->name('studentreport');
    Route::get('/studetails', [StudentProfile::class, 'studetails'])->name('studetails');


    //expense manage Controller
    //Route::get('/expense',[ExpenseController::class, 'expense'])->name('expense');
    Route::get('/expensename', [ExpenseController::class, 'expensename'])->name('expensename');
    Route::get('/expensenameadd', [ExpenseController::class, 'expensenameadd'])->name('expensenameadd');
    Route::post('/expensenamestore', [ExpenseController::class, 'expensenamestore'])->name('expensenamestore');

    Route::get('/expense', [ExpenseController::class, 'expense'])->name('expense');
    Route::get('/expenseadd', [ExpenseController::class, 'expenseadd'])->name('expenseadd');
    Route::post('/storeexpense', [ExpenseController::class, 'storeexpense'])->name('storeexpense');

    //earninig manage Controller
    Route::get('/earningname', [EarningController::class, 'earningname'])->name('earningname');
    Route::get('/earningnameadd', [EarningController::class, 'earningnameadd'])->name('earningnameadd');
    Route::post('/earningnamestore', [EarningController::class, 'earningnamestore'])->name('earningnamestore');

    Route::get('/earning', [EarningController::class, 'earning'])->name('earning');
    Route::get('/earningadd', [EarningController::class, 'earningadd'])->name('earningadd');
    Route::post('/storeearning', [EarningController::class, 'storeearning'])->name('storeearning');
    Route::get('/moneyreceipt/{id}', [EarningController::class, 'moneyreceipt'])->name('moneyreceipt');

    //report
    Route::get('/dailystatementdate', [ReportController::class, 'dailystatementdate'])->name('dailystatementdate');
    Route::post('/dailystatement', [ReportController::class, 'dailystatement'])->name('dailystatement');
    Route::get('/monthlystatementdate', [ReportController::class, 'monthlystatementdate'])->name('monthlystatementdate');
    Route::post('/monthlystatement', [ReportController::class, 'monthlystatement'])->name('monthlystatement');
    Route::get('/totalcostearn', [ReportController::class, 'totalcostearn'])->name('totalcostearn');

    Route::get('/datewiseexpanse', [ReportController::class, 'datewiseexpanse'])->name('datewiseexpanse');

    Route::get('/earningnamewise', [ReportController::class, 'earningnamewise'])->name('earningnamewise');
    Route::post('/earningnamewisestatement', [ReportController::class, 'earningnamewisestatement'])->name('earningnamewisestatement');

    Route::get('/profitedaterange', [ReportController::class, 'profitedaterange'])->name('profitedaterange');
    Route::post('/profitedaterangestatement', [ReportController::class, 'profitedaterangestatement'])->name('profitedaterangestatement');





    Route::get('/home-settings/edit', [HomeSettingController::class, 'edit'])->name('home_settings.edit');
    Route::post('/home-settings/update', [HomeSettingController::class, 'update'])->name('home_settings.update');
    Route::get('/about-settings/edit', [AboutSettingController::class, 'edit'])->name('about_settings.edit');
    Route::post('/about-settings/update', [AboutSettingController::class, 'update'])->name('about_settings.update');

    // Website Setup
    Route::resource('countries', CountryController::class);
    Route::resource('why_chooses', WhyChooseController::class);
    Route::resource('student_visas', StudentVisaController::class);
    Route::resource('student_reviews', StudentReviewController::class);
    Route::resource('blogs', BlogController::class);
    Route::resource('our_services', OurServiceController::class);
    Route::resource('ongoing_activities', OngoingActivityController::class);
    Route::resource('photo_gallery', PhotoGalleryController::class);
    Route::resource('upcoming_events', UpcomingEventController::class);
    Route::resource('teams', TeamController::class);
});

Route::get('loginuser', [UserController::class, 'loginuser'])->name('loginuser');
Route::get('userregistration', [UserController::class, 'userregistration'])->name('userregistration');
Route::post('storeUser', [UserController::class, 'storeUser'])->name('storeUser');
Route::post('userlogin', [UserController::class, 'userlogin'])->name('userlogin');

Route::group(['middleware' => 'auth'], function () {
    Route::get('userdeshboard', [UserController::class, 'userdeshboard'])->name('userdeshboard');
    Route::post('userlogout', [UserController::class, 'userlogout'])->name('userlogout');
});
