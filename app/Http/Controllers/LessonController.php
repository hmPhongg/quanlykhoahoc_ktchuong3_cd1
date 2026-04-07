<?php 
namespace App\Http\Controllers;
use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Http\Request;

class LessonController extends Controller {
    public function index($courseId) {
        $course = Course::findOrFail($courseId);
        $lessons = $course->lessons()->orderBy('order')->get();
        return view('lessons.index', compact('course','lessons'));
    }
    public function store(Request $request, $courseId) {
        $request->validate(['title'=>'required','content'=>'required','order'=>'nullable|integer']);
        Lesson::create([...$request->only('title','content','video_url','order'), 'course_id'=>$courseId]);
        return back()->with('success','Thêm bài học thành công');
    }
    // update, destroy tương tự...
}