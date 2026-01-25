<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Branch;
use App\Models\HomeSetting;
use App\Models\AboutSetting;
use App\Models\CourseSetup;
use App\Models\Country;
use App\Models\StudentVisa;
use App\Models\StudentReview;
use App\Models\OurService;
use App\Models\OngoingActivity;
use App\Models\PhotoGallery;
use App\Models\UpcomingEvent;
use DB;
use Illuminate\Support\Str;

class homeController extends Controller
{

    public function generateQRCode(Request $request)
    {
        $data = $request->get('qr_data', 'No data provided');
        $qrCodeImage = \QrCode::size(300)->margin(2)->generate($data);

        return view('backend.qr_code', [
            'qrCodeImage' => $qrCodeImage,
            'encodedData' => $data
        ]);
    }

    public function downloadQRCode(Request $request)
    {
        $data = $request->get('data', 'No data provided');
        $filename = 'qr-code-' . time() . '.png';

        // Generate QR code image
        $qrCodeImage = \QrCode::format('png')
            ->size(300)
            ->margin(2)
            ->generate($data);

        return response($qrCodeImage)
            ->header('Content-Type', 'image/png')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }
    public function home()
    {
        $homeSetting = HomeSetting::first();
        $aboutSetting = AboutSetting::first();
        $countries = Country::all();
        $whyChooses = \App\Models\WhyChoose::all();
        $courses = CourseSetup::with('category')->get();
        $studentVisas = StudentVisa::all();
        $studentReviews = StudentReview::orderBy('created_at', 'desc')->limit(6)->get();
        $ourServices = OurService::latest()->get();
        $ongoingActivities = OngoingActivity::latest()->limit(6)->get();
        $photoGalleries = PhotoGallery::latest()->limit(6)->get();
        $upcomingEvents = UpcomingEvent::orderBy('date', 'asc')->limit(6)->get();
        return view('frontend.home', compact('homeSetting', 'aboutSetting', 'countries', 'whyChooses', 'courses','studentReviews','studentVisas', 'ourServices', 'ongoingActivities', 'photoGalleries', 'upcomingEvents'));
    }

    public function Procedure()
    {
        return view('frontend.procedure');
    }

    public function blog()
    {
        return view('frontend.blog');
    }

    public function courses()
    {
        $courses = CourseSetup::with('category')->get();
        return view('frontend.courses', compact('courses'));
    }

    public function about()
    {
        $aboutSetting = AboutSetting::first();
        return view('frontend.about', compact('aboutSetting'));
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function deshboard()
    {
        return view('backend.deshboard');
    }
    public function adminlogout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('login');
    }
    public function settings()
    {
        $data['settings'] = DB::table('settings')->orderBy('id', 'DESC')->first();
        return view('backend.settings.settings', $data);
    }

    public function storesettings(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $setting = \App\Models\Setting::orderBy('id', 'DESC')->first();
        $data = $validated;

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = time() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('backend/img/logo'), $logoName);
            $data['logo'] = 'backend/img/logo/' . $logoName;
        }

        if ($setting) {
            $setting->update($data);
            $flashdata = ['class' => 'success', 'message' => 'Settings updated successfully!'];
        } else {
            \App\Models\Setting::create($data);
            $flashdata = ['class' => 'success', 'message' => 'Settings created successfully!'];
        }

        return redirect()->back()->with($flashdata);
    }

    public function branch()
    {
        $data['branch'] = Branch::all();
        return view('backend.branch.branch', $data);
    }

    public function addbranch()
    {
        return view('backend.branch.addbranch');
    }

    public function storebranch(Request $request)
    {
        $dataInput = [
            'branch_name' => $request->branch_name
        ];

        Branch::create($dataInput);

        $flashdata = ['class' => 'success', 'message' => "Settings Insert Successfull "];
        return redirect()->back()->with($flashdata);

    }

    public function editbranch($id)
    {
        $data['branch'] = DB::table('branches')->where('id', $id)->first();
        return view('backend.branch.edieditbrancht', $data);
    }

    public function CourseDetail($slug)
    {
        $course = \App\Models\CourseSetup::with('category')->where('slug', $slug)->firstOrFail();
        $categories = \App\Models\Category::all();
        $recentCourses = \App\Models\CourseSetup::orderBy('created_at', 'desc')->limit(6)->get();
        $tags = []; // If you have tags, fetch here

        return view('frontend.course_details', compact('course', 'categories', 'recentCourses', 'tags'));
    }

}
