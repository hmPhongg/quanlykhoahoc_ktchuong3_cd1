<?php 
namespace App\Http\Controllers;
use App\Models\Enrollment;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;

class EnrollmentController extends Controller {
    public function index(Request $request, $courseId = null) {
        $query = Enrollment::with(['course','student']);
        if ($courseId) $query->where('course_id', $courseId);
        return view('enrollments.index', ['enrollments' => $query->latest()->paginate(15)]);
    }

    public function create() {
        return view('enrollments.create', ['courses' => Course::published()->get()]);
    }

    public function store(Request $request) {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'name'      => 'required|string|max:255',
            'email'     => 'required|email',
        ]);
        $student = Student::firstOrCreate(['email' => $request->email], ['name' => $request->name]);
        Enrollment::firstOrCreate(['course_id' => $request->course_id, 'student_id' => $student->id]);
        return redirect()->back()->with('success', 'Đăng ký thành công!');
    }
}