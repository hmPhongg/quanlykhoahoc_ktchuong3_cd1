<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Course extends Model {
    use SoftDeletes;
    protected $fillable = ['name','slug','price','description','image','status'];

    // Quan hệ
    public function lessons() { return $this->hasMany(Lesson::class)->orderBy('order'); }
    public function enrollments() { return $this->hasMany(Enrollment::class); }
    public function students() { return $this->belongsToMany(Student::class, 'enrollments', 'course_id', 'student_id'); }

    // Scope nâng cao
    public function scopePublished($query) { return $query->where('status', 'published'); }
    public function scopePriceBetween($query, $min, $max) { return $query->whereBetween('price', [$min, $max]); }

    // Tự sinh slug
    public static function boot() {
        parent::boot();
        static::creating(function($course) {
            if(!$course->slug) $course->slug = Str::slug($course->name);
        });
    }
}