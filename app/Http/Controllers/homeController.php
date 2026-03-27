<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Cache;
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
use App\Models\Membership;
use App\Models\Committee;
use App\Models\Blog;
use App\Models\Advisor;
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
        $homeSetting = Cache::remember('home_setting', 3600, function () {
            return HomeSetting::first();
        });

        $aboutSetting = Cache::remember('about_setting', 3600, function () {
            return AboutSetting::select('id', 'campus_image', 'campus_title', 'campus_description')->first();
        });

        $ourServices = Cache::remember('home_services', 3600, function () {
            return OurService::latest()->select('id', 'title', 'sub_title', 'icon')->limit(6)->get();
        });

        $ongoingActivities = OngoingActivity::latest()
            ->select('id', 'title', 'sub_title', 'thumbnail')
            ->limit(6)->get();

        $photoGalleries = PhotoGallery::latest()
            ->select('id', 'image', 'is_pinned')
            ->limit(8)->get();

        $pinnedPhotos = PhotoGallery::where('is_pinned', true)
            ->latest()
            ->select('id', 'image')
            ->limit(6)->get();

        $upcomingEvents = UpcomingEvent::orderBy('date', 'asc')
            ->select('id', 'title', 'sub_title', 'date', 'is_pinned')
            ->limit(6)->get();

        $latestBlogs = Blog::where('status', 'published')
            ->latest()
            ->select('id', 'title', 'excerpt', 'content', 'image', 'is_pinned', 'created_at')
            ->limit(3)->get();

        $pinnedNews = Blog::where('is_pinned', true)->where('status', 'published')
            ->latest()
            ->select('id', 'title')
            ->get();

        $pinnedEvents = UpcomingEvent::where('is_pinned', true)
            ->latest()
            ->select('id', 'title', 'date')
            ->get();

        $marqueeItems = $pinnedNews->concat($pinnedEvents)->shuffle();

        $leadershipMessages = Cache::remember('leadership_messages', 3600, function () {
            return \App\Models\LeadershipMessage::active()->ordered()->get();
        });

        $constitution = Cache::remember('constitution', 3600, function () {
            return \App\Models\Bylaw::first();
        });

        return view('frontend.home', compact(
            'homeSetting', 'aboutSetting', 'ourServices', 'ongoingActivities',
            'photoGalleries', 'pinnedPhotos', 'upcomingEvents', 'latestBlogs',
            'leadershipMessages', 'constitution', 'marqueeItems'
        ));
    }

    public function Procedure()
    {
        return view('frontend.procedure');
    }

    public function blog()
    {
        return view('frontend.blog');
    }

    public function teams()
    {
        $teams = \App\Models\Team::latest()->get();
        return view('frontend.teams', compact('teams'));
    }

    public function courses()
    {
        $courses = CourseSetup::with('category')->get();
        return view('frontend.courses', compact('courses'));
    }

    public function about()
    {
        $aboutSetting = Cache::remember('about_setting_full', 3600, function () {
            return AboutSetting::first();
        });
        return view('frontend.about', compact('aboutSetting'));
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function deshboard()
    {
        $memberships = Membership::latest()->paginate(20);
        return view('backend.deshboard', compact('memberships'));
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
            'company_name_bn' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,ico|max:1024',
        ]);

        $setting = \App\Models\Setting::orderBy('id', 'DESC')->first();
        $data = $validated;

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = 'logo_'.time() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('backend/img/logo'), $logoName);
            $data['logo'] = 'backend/img/logo/' . $logoName;
        }

        if ($request->hasFile('favicon')) {
            $favicon = $request->file('favicon');
            $faviconName = 'favicon_'.time() . '.' . $favicon->getClientOriginalExtension();
            if (!file_exists(public_path('backend/img/favicon'))) {
                mkdir(public_path('backend/img/favicon'), 0755, true);
            }
            $favicon->move(public_path('backend/img/favicon'), $faviconName);
            $data['favicon'] = 'backend/img/favicon/' . $faviconName;
        }

        if ($setting) {
            $setting->update($data);
            $flashdata = ['class' => 'success', 'message' => 'Settings updated successfully!'];
        } else {
            \App\Models\Setting::create($data);
            $flashdata = ['class' => 'success', 'message' => 'Settings created successfully!'];
        }

        Cache::forget('site_settings');
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

    public function donation()
    {
        return view('frontend.donation');
    }

    // About Section Methods
    public function missionVision()
    {
        return view('frontend.mission-vision');
    }

    public function aimsObjectives()
    {
        return view('frontend.aims-objectives');
    }

    public function constitution()
    {
        return view('frontend.constitution');
    }

    public function message()
    {
        return view('frontend.message');
    }

    // Content Section Methods
    public function news()
    {
        $news = Blog::where('status', 'published')
            ->latest()
            ->select('id', 'title', 'excerpt', 'content', 'image', 'created_at')
            ->paginate(12);
        return view('frontend.news', compact('news'));
    }

    public function events()
    {
        $upcomingEvents = UpcomingEvent::orderBy('date', 'asc')
            ->select('id', 'title', 'sub_title', 'date')
            ->paginate(12);
        return view('frontend.events', compact('upcomingEvents'));
    }

    public function activities()
    {
        $ongoingActivities = OngoingActivity::latest()
            ->select('id', 'title', 'sub_title', 'thumbnail')
            ->paginate(12);
        return view('frontend.activities', compact('ongoingActivities'));
    }

    public function gallery()
    {
        $photoGalleries = PhotoGallery::latest()
            ->select('id', 'image', 'is_pinned')
            ->paginate(24);
        return view('frontend.gallery', compact('photoGalleries'));
    }

    // Committee Methods
    public function executiveCommittee()
    {
        $committees = Cache::remember('executive_committee', 3600, function () {
            return Committee::orderBy('position_order')->get();
        });
        return view('frontend.executive-committee', compact('committees'));
    }

    public function advisoryCouncil()
    {
        $advisors = Cache::remember('advisory_council', 3600, function () {
            return Advisor::active()->ordered()->get();
        });
        return view('frontend.advisory-council', compact('advisors'));
    }

    // Bylaws page removed - Constitution now displayed on home page
    // public function bylaws()
    // {
    //     $bylaw = \App\Models\Bylaw::first();
    //     return view('frontend.bylaws', compact('bylaw'));
    // }

}
