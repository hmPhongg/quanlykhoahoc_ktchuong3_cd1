<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Lấy kèm số lượng enrollment để tính toán & sắp xếp
        $courses = Course::withCount('enrollments')->get();

        return view('dashboard', [
            'totalCourses'  => Course::count(),
            
            // ✅ FIX 1: distinct() không nhận tham số column. Dùng select()->distinct()->count() an toàn nhất
            'totalStudents' => Enrollment::select('student_id')->distinct()->count(),
            
            // ✅ FIX 2 & 3: Thay join thủ công bằng Collection sum()
            // Tự động loại trừ Soft Delete, code sạch hơn, tránh lỗi cú pháp \DB
            'totalRevenue'  => $courses->sum(fn($c) => $c->price * $c->enrollments_count),
            
            // ✅ FIX 4: Dùng dữ liệu đã load ở trên để tránh query thừa
            'topCourse'     => $courses->sortByDesc('enrollments_count')->first(),
            
            'newCourses'    => Course::latest()->take(5)->get(),
        ]);
    }
}