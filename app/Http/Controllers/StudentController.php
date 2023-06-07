<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = User::where('parent_id', auth()->user()->id)->get();
        return response()->json($students);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string|min:10|max:15',
            'school' => 'required|string',
            'age' => 'required|integer',
            'gender' => 'required|string',
            'defer' => 'boolean',
            'active' => 'boolean',
        ]);

        $data['type'] = User::TYPE_STUDENT;
        $data['parent_id'] = auth()->user()->id;

        $student = User::create($data);

        return response()->json($student, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($studentId)
    {
        $student = User::where('parent_id', auth()->user()->id)
            ->where('id', $studentId)
            ->first();

        if (!$student) {
            return response()->json(['error' => 'Student not found'], 404);
        }

        return response()->json($student);
    }

    /**
     * @param Request $request
     * @param $studentId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $studentId)
    {
        $student = User::where('parent_id', auth()->user()->id)
            ->where('id', $studentId)
            ->firstOrFail();

        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string|min:10|max:15',
            'school' => 'required|string',
            'age' => 'required|integer',
            'gender' => 'required|string',
            'defer' => 'boolean',
            'active' => 'boolean',
        ]);

        $student->update($data);

        return response()->json($student);
    }

    /**
     * @param $studentId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($studentId)
    {
        $student = User::where('parent_id', auth()->user()->id)
            ->where('id', $studentId)
            ->firstOrFail();

        $student->delete();

        return response()->json(['message' => 'Student deleted successfully']);
    }
}
