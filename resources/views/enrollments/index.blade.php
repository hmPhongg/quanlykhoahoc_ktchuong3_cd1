@extends('layouts.master')
@section('title', 'Danh sách đăng ký')

@section('breadcrumb')
    <li class="breadcrumb-item active">Enrollments</li>
@endsection

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h5 class="mb-0">👥 Danh sách học viên đăng ký</h5>
        <a href="{{ route('enrollments.create') }}" class="btn btn-success btn-sm">
            <i class="bi bi-person-plus"></i> Đăng ký mới
        </a>
    </div>
    
    <div class="card-body">
        <x-table :headers="['Khóa học', 'Học viên', 'Email', 'Ngày đăng ký', 'Thao tác']">
            @forelse($enrollments as $enrollment)
            <tr>
                <td>
                    <strong>{{ $enrollment->course->name }}</strong><br>
                    <small class="text-muted">{{ number_format($enrollment->course->price,0,',','.') }} đ</small>
                </td>
                <td>{{ $enrollment->student->name }}</td>
                <td>{{ $enrollment->student->email }}</td>
                <td>{{ $enrollment->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Hủy đăng ký này?')">
                        <i class="bi bi-x-circle"></i> Hủy
                    </button>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center py-4">Chưa có học viên nào đăng ký</td></tr>
            @endforelse
        </x-table>
        
        <div class="mt-3">
            {{ $enrollments->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection