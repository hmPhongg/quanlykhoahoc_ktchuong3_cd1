@extends('layouts.master')
@section('title', 'Bài học - '.$course->name)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('courses.index') }}">Courses</a></li>
    <li class="breadcrumb-item"><a href="{{ route('courses.index') }}">{{ $course->name }}</a></li>
    <li class="breadcrumb-item active">Bài học</li>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4>📖 Bài học: {{ $course->name }}</h4>
        <span class="text-muted">{{ $lessons->count() }} bài học</span>
    </div>
    <div>
        <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary btn-sm">← Quay lại</a>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addLessonModal">
            <i class="bi bi-plus-lg"></i> Thêm bài học
        </button>
    </div>
</div>

<!-- Lessons List -->
<div class="card shadow-sm">
    <div class="card-body">
        @forelse($lessons as $lesson)
        <div class="border rounded p-3 mb-2 d-flex justify-content-between align-items-center">
            <div>
                <strong>#{{ $lesson->order }} - {{ $lesson->title }}</strong>
                @if($lesson->video_url)
                    <br><small class="text-primary"><i class="bi bi-play-circle"></i> Có video</small>
                @endif
            </div>
            <div class="btn-group btn-group-sm">
                <button class="btn btn-outline-warning">✏️</button>
                <button class="btn btn-outline-danger">🗑️</button>
            </div>
        </div>
        @empty
        <p class="text-center text-muted py-4">Chưa có bài học nào. Hãy thêm bài học đầu tiên!</p>
        @endforelse
    </div>
</div>

<!-- Modal Add Lesson -->
<div class="modal fade" id="addLessonModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('lessons.store', $course->id) }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">➕ Thêm bài học mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <x-form.input label="Tiêu đề" name="title" required placeholder="Nhập tiêu đề bài học" />
                <x-form.textarea label="Nội dung" name="content" required placeholder="Nội dung bài học..." />
                <x-form.input label="Video URL (YouTube/Embed)" name="video_url" type="url" placeholder="https://..." />
                <x-form.input label="Thứ tự hiển thị" name="order" type="number" value="{{ $lessons->count() + 1 }}" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="submit" class="btn btn-primary">💾 Lưu bài học</button>
            </div>
        </form>
    </div>
</div>
@endsection