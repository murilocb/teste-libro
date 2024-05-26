<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return response()->json($courses);
    }

    public function store(Request $request)
    {
        $request->validate(Course::rules());

        $course = Course::create($request->all());
        return response()->json($course, 201);
    }

    public function show($id)
    {
        $course = Course::findOrFail($id);
        return response()->json($course);
    }

    public function update(Request $request, $id)
    {
        $request->validate(Course::rules());

        $course = Course::findOrFail($id);
        $course->update($request->all());
        return response()->json($course, 200);
    }

    public function destroy($id)
    {
        Course::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}

