@extends('layouts.master')
@section('title', 'Danh sách khóa học')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('courses.index') }}">Courses</a></li>
    <li class="breadcrumb-item active">Danh sách</li>
@endsection

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h5 class="mb-0">📚 Danh sách khóa học</h5>
        <a href="{{ route('courses.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg"></i> Thêm mới
        </a>
    </div>
    
    <div class="card-body">
        <!-- Search & Filter Form -->
        <form method="GET" class="row g-3 mb-4">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" 
                       placeholder="Tìm theo tên..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">Tất cả trạng thái</option>
                    <option value="published" {{ request('status')=='published'?'selected':'' }}>Published</option>
                    <option value="draft" {{ request('status')=='draft'?'selected':'' }}>Draft</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="sort" class="form-select" onchange="this.form.submit()">
                    <option value="">Sắp xếp theo</option>
                    <option value="price_asc" {{ request('sort')=='price_asc'?'selected':'' }}>Giá tăng dần</option>
                    <option value="price_desc" {{ request('sort')=='price_desc'?'selected':'' }}>Giá giảm dần</option>
                    <option value="enrollments" {{ request('sort')=='enrollments'?'selected':'' }}>Nhiều học viên</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-outline-primary w-100">
                    <i class="bi bi-search"></i> Lọc
                </button>
            </div>
        </form>

        <!-- Courses Table -->
        <x-table :headers="['Ảnh', 'Tên khóa học', 'Giá', 'Bài học', 'Học viên', 'Trạng thái', 'Thao tác']">
            @forelse($courses as $course)
            <tr>
                <td>
                    @if($course->image)
                        <img src="{{ asset('storage/'.$course->image) }}" class="img-course" alt="{{ $course->name }}">
                    @else
                        <span class="text-muted">No img</span>
                    @endif
                </td>
                <td>
                    <strong>{{ $course->name }}</strong><br>
                    <small class="text-muted">{{ $course->slug }}</small>
                </td>
                <td>{{ number_format($course->price, 0, ',', '.') }} đ</td>
                <td><span class="badge bg-info">{{ $course->lessons_count }}</span></td>
                <td><span class="badge bg-success">{{ $course->enrollments_count }}</span></td>
                <td><x-badge :status="$course->status" /></td>
                <td>
                    <div class="btn-group btn-group-sm">
                        <a href="{{ route('lessons.index', $course->id) }}" class="btn btn-outline-primary" title="Quản lý bài học">
                            <i class="bi bi-journal-text"></i>
                        </a>
                        <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-outline-warning" title="Sửa">
                            <i class="bi bi-pencil"></i>
                        </a>
                        @if($course->trashed())
                            <form action="{{ route('courses.restore', $course->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-outline-success" title="Khôi phục" onclick="return confirm('Khôi phục khóa học này?')">
                                    <i class="bi bi-arrow-counterclockwise"></i>
                                </button>
                            </form>
                        @else
                            <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-outline-danger" title="Xóa mềm" onclick="return confirm('Xóa mềm khóa học này?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" class="text-center py-4">Chưa có khóa học nào</td></tr>
            @endforelse
        </x-table>

        <!-- Pagination -->
        <div class="mt-3">
            {{ $courses->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection