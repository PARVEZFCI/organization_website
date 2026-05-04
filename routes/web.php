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
use App\Http\Controllers\Admin\CommitteeController;
use App\Http\Controllers\Admin\PastCommitteePeriodController;
use App\Http\Controllers\Admin\PastCommitteeMemberController;
use App\Http\Controllers\Admin\AdvisorController;
use App\Http\Controllers\Admin\AdminMembershipFeeController;
use App\Http\Controllers\Admin\AdminMembershipController;
use App\Http\Controllers\Admin\AdminMonthlyPaymentController;
use App\Http\Controllers\Admin\BylawController;
use App\Http\Controllers\Admin\LeadershipMessageController;
use App\Http\Controllers\PublicRegistrationController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\BkashPaymentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Member\MemberAuthController;
use App\Http\Controllers\Member\MemberDashboardController;
use App\Http\Controllers\Admin\EventRegistrationController;


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
Route::get('/about/mission-vision', [homeController::class, 'missionVision'])->name('about.mission-vision');
Route::get('/about/aims-objectives', [homeController::class, 'aimsObjectives'])->name('about.aims-objectives');
Route::redirect('/about/vision', '/about/mission-vision')->name('about.vision');
Route::redirect('/about/mission', '/about/mission-vision')->name('about.mission');
Route::redirect('/about/aim', '/about/aims-objectives')->name('about.aim');
Route::redirect('/about/objective', '/about/aims-objectives')->name('about.objective');
Route::redirect('/mission-vision', '/about/mission-vision')->name('mission.vision');
Route::redirect('/aims-objectives', '/about/aims-objectives')->name('aims.objectives');
Route::get('/constitution', [homeController::class, 'constitution'])->name('constitution');
Route::get('/message', [homeController::class, 'message'])->name('message');

// Content Section Routes
Route::get('/news', [homeController::class, 'news'])->name('news');
Route::get('/event', [homeController::class, 'events'])->name('events');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
Route::post('/events/{event}/register', [EventController::class, 'register'])->name('events.register');
Route::get('/activities', [homeController::class, 'activities'])->name('activities');
Route::get('/gallery', [homeController::class, 'gallery'])->name('gallery');

// Committee Routes
Route::get('/executive-committee', [homeController::class, 'executiveCommittee'])->name('executive-committee');
Route::get('/past-leaders', [homeController::class, 'pastLeaders'])->name('past-leaders');
Route::get('/past-leaders/{period}', [homeController::class, 'pastLeadersPeriod'])->name('past-leaders.period');
Route::get('/advisory-council', [homeController::class, 'advisoryCouncil'])->name('advisory-council');
// Route::get('/bylaws', [homeController::class, 'bylaws'])->name('bylaws'); // Removed - Constitution now on home page

// Other Routes
Route::get('/contact', [homeController::class, 'contact'])->name('contact');
Route::get('/donation', [homeController::class, 'donation'])->name('donation.page');

// Membership form
Route::get('/membership', [App\Http\Controllers\MembershipController::class, 'create'])->name('membership.form');
Route::post('/membership', [App\Http\Controllers\MembershipController::class, 'store'])->name('membership.store');
Route::get('/memberships', [App\Http\Controllers\MembershipController::class, 'index'])->name('memberships.list');
Route::get('/memberships/general', [App\Http\Controllers\MembershipController::class, 'general'])->name('memberships.general');
Route::get('/memberships/life', [App\Http\Controllers\MembershipController::class, 'life'])->name('memberships.life');
Route::get('/memberships/associate', [App\Http\Controllers\MembershipController::class, 'associate'])->name('memberships.associate');
Route::get('/memberships/founder', [App\Http\Controllers\MembershipController::class, 'founder'])->name('memberships.founder');

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
    Route::post('blogs/{id}/toggle-pin', [BlogController::class, 'togglePin'])->name('blogs.togglePin');
    Route::resource('our_services', OurServiceController::class);
    Route::resource('ongoing_activities', OngoingActivityController::class);
    Route::resource('photo_gallery', PhotoGalleryController::class);
    Route::post('photo_gallery/{id}/toggle-pin', [PhotoGalleryController::class, 'togglePin'])->name('photo_gallery.toggle_pin');
    Route::resource('upcoming_events', UpcomingEventController::class);
    Route::post('upcoming_events/{id}/toggle-pin', [UpcomingEventController::class, 'togglePin'])->name('upcoming_events.togglePin');
    Route::get('upcoming_events/{event}/registrations', [EventRegistrationController::class, 'index'])->name('upcoming_events.registrations');
    Route::resource('teams', TeamController::class);
    Route::resource('committee', CommitteeController::class);
    Route::resource('past-committee-periods', PastCommitteePeriodController::class);
    Route::get('past-committee-periods/{period}/members/create', [PastCommitteeMemberController::class, 'create'])->name('past-committee-members.create');
    Route::post('past-committee-periods/{period}/members', [PastCommitteeMemberController::class, 'store'])->name('past-committee-members.store');
    Route::get('past-committee-periods/{period}/members/{member}/edit', [PastCommitteeMemberController::class, 'edit'])->name('past-committee-members.edit');
    Route::put('past-committee-periods/{period}/members/{member}', [PastCommitteeMemberController::class, 'update'])->name('past-committee-members.update');
    Route::delete('past-committee-periods/{period}/members/{member}', [PastCommitteeMemberController::class, 'destroy'])->name('past-committee-members.destroy');
    Route::resource('advisors', AdvisorController::class);
    Route::resource('membership_fees', AdminMembershipFeeController::class);
    Route::resource('membership', AdminMembershipController::class);
    Route::post('membership/{id}/approve', [AdminMembershipController::class, 'approve'])->name('membership.approve');
    Route::post('membership/{id}/toggle-status', [AdminMembershipController::class, 'toggleStatus'])->name('membership.toggle_status');
    Route::get('membership/{id}/change-password', [AdminMembershipController::class, 'editPassword'])->name('membership.password.edit');
    Route::post('membership/{id}/change-password', [AdminMembershipController::class, 'updatePassword'])->name('membership.password.update');

    // Monthly Payments
    Route::get('monthly-payments', [AdminMonthlyPaymentController::class, 'index'])->name('monthly_payments.index');
    Route::get('monthly-payments/member/{membership}', [AdminMonthlyPaymentController::class, 'memberPayments'])->name('monthly_payments.member');
    Route::post('monthly-payments/{payment}/mark-paid', [AdminMonthlyPaymentController::class, 'markPaid'])->name('monthly_payments.mark_paid');
    Route::post('monthly-payments/{payment}/mark-due', [AdminMonthlyPaymentController::class, 'markDue'])->name('monthly_payments.mark_due');
    Route::post('monthly-payments/generate-missing/{membership}', [AdminMonthlyPaymentController::class, 'generateMissing'])->name('monthly_payments.generate_missing');
    Route::post('monthly-payments/generate-next/{membership}', [AdminMonthlyPaymentController::class, 'generateNext'])->name('monthly_payments.generate_next');
    Route::post('monthly-payments/bulk-mark-paid', [AdminMonthlyPaymentController::class, 'bulkMarkPaid'])->name('monthly_payments.bulk_mark_paid');

    // Bylaws
    Route::get('/bylaws/edit', [BylawController::class, 'edit'])->name('bylaws.edit');
    Route::post('/bylaws/update', [BylawController::class, 'update'])->name('bylaws.update');

    // Leadership Messages
    Route::resource('leadership_messages', LeadershipMessageController::class);
});

Route::get('loginuser', [UserController::class, 'loginuser'])->name('loginuser');
Route::get('userregistration', [UserController::class, 'userregistration'])->name('userregistration');
Route::post('storeUser', [UserController::class, 'storeUser'])->name('storeUser');
Route::post('userlogin', [UserController::class, 'userlogin'])->name('userlogin');

Route::group(['middleware' => 'auth'], function () {
    Route::get('userdeshboard', [UserController::class, 'userdeshboard'])->name('userdeshboard');
    Route::post('userlogout', [UserController::class, 'userlogout'])->name('userlogout');
});

// Member Authentication Routes
Route::get('member/login', [MemberAuthController::class, 'showLoginForm'])->name('member.login');
Route::post('member/login', [MemberAuthController::class, 'login'])->name('member.login.submit');

Route::group(['middleware' => 'member_auth', 'prefix' => 'member', 'as' => 'member.'], function () {
    Route::post('logout', [MemberAuthController::class, 'logout'])->name('logout');
    Route::get('dashboard', [MemberDashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('payments', [MemberDashboardController::class, 'payments'])->name('payments');
    Route::get('event-registrations/{registration}/proof', [MemberDashboardController::class, 'downloadEventProof'])->name('event-registrations.proof');
    Route::post('payments/bkash', [BkashPaymentController::class, 'createMembershipPayment'])->name('payments.bkash');
    Route::get('profile', [MemberDashboardController::class, 'profile'])->name('profile');
    Route::post('profile', [MemberDashboardController::class, 'updateProfile'])->name('profile.update');
    Route::get('change-password', [MemberDashboardController::class, 'changePassword'])->name('change-password');
    Route::post('change-password', [MemberDashboardController::class, 'updatePassword'])->name('change-password.update');
});
