<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SeminarRegistration;
use DB;
use Hash;

class PublicRegistrationController extends Controller
{
    public function showRegistrationForm()
    {
        $data['courses'] = Category::all();
        return view('frontend.public-registration', $data);
    }

    public function storeRegistration(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'course_id' => 'required|exists:categories,id',
            'education' => 'required|string',
            'message' => 'nullable|string'
        ]);

        try {
            SeminarRegistration::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'course_id' => $request->course_id,
                'education' => $request->education,
                'inquiry_message' => $request->message,
                'status' => 'pending',
            ]);
            return redirect()->back()->with('success', 'Thank you for your registration. We will contact you soon.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Sorry, there was an error processing your registration.')
                ->withInput();
        }
    }
}
