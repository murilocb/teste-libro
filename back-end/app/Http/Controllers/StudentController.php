<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return response()->json($students);
    }

    public function search(Request $request)
    {
        $query = Student::query();

        if ($request->has('name') && $request->has('email')) {
            $name = $request->input('name');
            $email = $request->input('email');

            $query->where(function ($q) use ($name, $email) {
                $q->where('name', 'like', '%' . $name . '%')
                ->where('email', $email);
            });
        } else {
            return response()->json(['error' => 'Nome e e-mail são obrigatórios'], 400);
        }

        $students = $query->get();

        return response()->json($students);
    }


    public function enroll(Request $request, $studentId)
    {
        $student = Student::findOrFail($studentId);

        if ($request->has('course_ids')) {
            $courseIds = $request->input('course_ids');

            $student->courses()->sync($courseIds);
        }

        return response()->json($student->courses);
    }

    public function studentsByAgeGroup(Request $request)
    {
        $query = Student::query();

        if ($request->has('course_id')) {
            $query->whereHas('courses', function ($q) use ($request) {
                $q->where('id', $request->course_id);
            });
        }

        if ($request->has('gender')) {
            $query->where('gender', $request->gender);
        }

        $students = $query->get();

        $ageGroups = [
            'Menor que 15 anos' => 0,
            'Entre 15 e 18 anos' => 0,
            'Entre 19 e 24 anos' => 0,
            'Entre 25 e 30 anos' => 0,
            'Maior que 30 anos' => 0,
        ];

        foreach ($students as $student) {
            $age = $student->date_of_birth->age;

            if ($age < 15) {
                $ageGroups['Menor que 15 anos']++;
            } elseif ($age >= 15 && $age <= 18) {
                $ageGroups['Entre 15 e 18 anos']++;
            } elseif ($age >= 19 && $age <= 24) {
                $ageGroups['Entre 19 e 24 anos']++;
            } elseif ($age >= 25 && $age <= 30) {
                $ageGroups['Entre 25 e 30 anos']++;
            } else {
                $ageGroups['Maior que 30 anos']++;
            }
        }

        return response()->json($ageGroups);
    }

    public function store(Request $request)
    {
        $request->validate(Student::rules());

        $student = Student::create($request->all());
        return response()->json($student, 201);
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        return response()->json($student);
    }

    public function update(Request $request, $id)
    {
        $request->validate(Student::rules());

        $student = Student::findOrFail($id);
        $student->update($request->all());
        return response()->json($student, 200);
    }

    public function destroy($id)
    {
        Student::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}

