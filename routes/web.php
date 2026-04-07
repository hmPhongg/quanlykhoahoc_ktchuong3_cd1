<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\EnrollmentController;
use App\Models\Course;
use App\Models\Enrollment;

// Dashboard
Route::get('/', function () {
    $courses = Course::withCount('enrollments')->get();
    
    return view('dashboard', [
        'totalCourses' => Course::count(),
        'totalStudents' => Enrollment::distinct()->count('student_id'),
        'totalRevenue' => $courses->sum(fn($c) => $c->enrollments_count * $c->price),
        'topCourse' => $courses->sortByDesc('enrollments_count')->first(),
        'newCourses' => Course::latest()->take(5)->get(),
        'coursesStats' => $courses,
    ]);
})->name('dashboard');

// Courses Resource (excluding show)
Route::resource('courses', CourseController::class)->except(['show']);

// Restore course
Route::post('courses/{id}/restore', [CourseController::class, 'restore'])->name('courses.restore');

// Lessons nested in courses
Route::prefix('courses/{courseId}/lessons')->controller(LessonController::class)->group(function() {
    Route::get('/', 'index')->name('lessons.index');
    Route::post('/', 'store')->name('lessons.store');
    // Add update and destroy if needed
    Route::put('/{id}', 'update')->name('lessons.update');
    Route::delete('/{id}', 'destroy')->name('lessons.destroy');
});

// Enrollments
Route::get('enrollments', [EnrollmentController::class, 'index'])->name('enrollments.index');
Route::get('enrollments/create', [EnrollmentController::class, 'create'])->name('enrollments.create');
Route::post('enrollments', [EnrollmentController::class, 'store'])->name('enrollments.store');