<?php

namespace App\Http\Controllers;
use App\Models\Course;
use App\Http\Requests\CourseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller {
    public function index(Request $request) {
        $query = Course::withCount('lessons', 'enrollments')->latest();

        // Tìm kiếm & Lọc
        if ($request->filled('search')) $query->where('name', 'like', "%{$request->search}%");
        if ($request->filled('status')) $query->where('status', $request->status);
        if ($request->filled('sort')) {
            match ($request->sort) {
                'price_asc'  => $query->orderBy('price'),
                'price_desc' => $query->orderByDesc('price'),
                'enrollments'=> $query->orderByDesc('enrollments_count'),
                default      => $query->latest()
            };
        }

        return view('courses.index', ['courses' => $query->paginate(10)]);
    }

    public function create() { return view('courses.create'); }

    public function store(CourseRequest $request) {
        $data = $request->validated();
        if ($request->hasFile('image')) $data['image'] = $request->file('image')->store('courses', 'public');
        Course::create($data);
        return redirect()->route('courses.index')->with('success', 'Thêm khóa học thành công!');
    }

    public function edit(Course $course) { return view('courses.edit', compact('course')); }

    public function update(CourseRequest $request, Course $course) {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('courses', 'public');
        }
        $course->update($data);
        return redirect()->route('courses.index')->with('success', 'Cập nhật thành công!');
    }

    public function destroy(Course $course) {
        $course->delete(); // Soft delete
        return back()->with('success', 'Đã xóa mềm khóa học!');
    }

    public function restore($id) {
        Course::withTrashed()->findOrFail($id)->restore();
        return back()->with('success', 'Đã khôi phục khóa học!');
    }
}