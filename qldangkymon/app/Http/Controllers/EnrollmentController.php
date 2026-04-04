<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::with('student', 'course')->latest()->get();

        $totalCredits = [];

        foreach ($enrollments as $enrollment) {
            $studentId = $enrollment->student_id;

            if (!isset($totalCredits[$studentId])) {
                $totalCredits[$studentId] = 0;
            }

            $totalCredits[$studentId] += $enrollment->course->credits;
        }

        return view('enrollments.index', compact('enrollments', 'totalCredits'));
    }

    public function create()
    {
        $students = Student::all();
        $courses = Course::all();

        return view('enrollments.create', compact('students', 'courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id'
        ], [
            'student_id.required' => 'Vui lòng chọn sinh viên.',
            'student_id.exists' => 'Sinh viên không tồn tại.',
            'course_id.required' => 'Vui lòng chọn môn học.',
            'course_id.exists' => 'Môn học không tồn tại.'
        ]);

        $exists = Enrollment::where('student_id', $request->student_id)
            ->where('course_id', $request->course_id)
            ->exists();

        if ($exists) {
            return redirect()->back()->withInput()->with('error', 'Sinh viên đã đăng ký môn học này rồi.');
        }

        $currentCredits = Enrollment::where('student_id', $request->student_id)
            ->join('courses', 'courses.id', '=', 'enrollments.course_id')
            ->sum('courses.credits');

        $course = Course::findOrFail($request->course_id);

        if (($currentCredits + $course->credits) > 18) {
            return redirect()->back()->withInput()->with('error', 'Tổng số tín chỉ vượt quá 18.');
        }

        Enrollment::create([
            'student_id' => $request->student_id,
            'course_id' => $request->course_id
        ]);

        return redirect()->route('enrollments.index')->with('success', 'Đăng ký môn học thành công!');
    }
}