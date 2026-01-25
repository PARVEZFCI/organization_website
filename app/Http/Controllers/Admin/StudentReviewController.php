<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentReview;

class StudentReviewController extends Controller
{
    public function index()
    {
        $reviews = StudentReview::all();
        return view('backend.student_reviews.index', compact('reviews'));
    }

    public function create()
    {
        return view('backend.student_reviews.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'course_name' => 'required|string|max:255',
            'comment' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);
        StudentReview::create($request->all());
        return redirect()->route('Admin.student_reviews.index')->with('success', 'Review added!');
    }

    public function edit($id)
    {
        $review = StudentReview::findOrFail($id);
        return view('backend.student_reviews.edit', compact('review'));
    }

    public function update(Request $request, $id)
    {
        $review = StudentReview::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'course_name' => 'required|string|max:255',
            'comment' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);
        $review->update($request->all());
        return redirect()->route('Admin.student_reviews.index')->with('success', 'Review updated!');
    }

    public function destroy($id)
    {
        $review = StudentReview::findOrFail($id);
        $review->delete();
        return redirect()->route('Admin.student_reviews.index')->with('success', 'Review deleted!');
    }
}
