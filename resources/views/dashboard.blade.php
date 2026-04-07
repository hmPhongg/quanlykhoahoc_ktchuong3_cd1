@extends('layouts.master')
@section('title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <x-card title="Tổng khóa học" :value="$totalCourses" icon="📚" color="primary" />
    </div>
    <div class="col-md-3">
        <x-card title="Tổng học viên" :value="$totalStudents" icon="👥" color="success" />
    </div>
    <div class="col-md-3">
        <x-card title="Doanh thu" :value="number_format($totalRevenue, 0, ',', '.').' đ'" icon="💰" color="warning" />
    </div>
    <div class="col-md-3">
        <x-card title="Khóa hot nhất" :value="$topCourse?->name ?? 'N/A'" icon="🔥" color="danger" />
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">📈 Thống kê theo khóa học</h5>
            </div>
            <div class="card-body">
                <x-table :headers="['Khóa học', 'Học viên', 'Doanh thu', 'Trạng thái']">
                    @forelse($coursesStats ?? [] as $stat)
                    <tr>
                        <td>{{ $stat->name }}</td>
                        <td><span class="badge bg-info">{{ $stat->enrollments_count }}</span></td>
                        <td>{{ number_format($stat->enrollments_count * $stat->price, 0, ',', '.') }} đ</td>
                        <td><x-badge :status="$stat->status" /></td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center py-3">Chưa có dữ liệu</td></tr>
                    @endforelse
                </x-table>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">🆕 Khóa học mới</h5>
            </div>
            <ul class="list-group list-group-flush">
                @forelse($newCourses ?? [] as $course)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ Str::limit($course->name, 30) }}</strong><br>
                        <small class="text-muted">{{ $course->created_at->format('d/m/Y') }}</small>
                    </div>
                    <span class="badge bg-primary rounded-pill">{{ $course->lessons_count }} bài</span>
                </li>
                @empty
                <li class="list-group-item text-center">Chưa có khóa học nào</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection