<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::all();
        return response()->json($enrollments);
    }

    public function store(Request $request)
    {
        $enrollment = Enrollment::create($request->all());
        return response()->json($enrollment, 201);
    }

    public function show($id)
    {
        $enrollment = Enrollment::findOrFail($id);
        return response()->json($enrollment);
    }

    public function update(Request $request, $id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $enrollment->update($request->all());
        return response()->json($enrollment, 200);
    }

    public function destroy($id)
    {
        Enrollment::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}

