<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentVisa;

class StudentVisaController extends Controller
{
    public function index()
    {
        $students = StudentVisa::all();
        return view('backend.student_visas.index', compact('students'));
    }

    public function create()
    {
        return view('backend.student_visas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('student_visas'), $imageName);
            $path = 'student_visas/' . $imageName;
        } else {
            $path = null;
        }
        StudentVisa::create(['image' => $path]);
        return redirect()->route('Admin.student_visas.index')->with('success', 'Student visa image added!');
    }

    public function edit($id)
    {
        $student = StudentVisa::findOrFail($id);
        return view('backend.student_visas.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $student = StudentVisa::findOrFail($id);
        $data = [];
        if ($request->hasFile('image')) {
            $request->validate(['image' => 'image']);
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('student_visas'), $imageName);
            $data['image'] = 'student_visas/' . $imageName;
        }
        $student->update($data);
        return redirect()->route('Admin.student_visas.index')->with('success', 'Student visa image updated!');
    }

    public function destroy($id)
    {
        $student = StudentVisa::findOrFail($id);
        $student->delete();
        return redirect()->route('Admin.student_visas.index')->with('success', 'Student visa image deleted!');
    }
}
