@extends('layouts.master')
@section('title', 'Đăng ký khóa học')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('enrollments.index') }}">Enrollments</a></li>
    <li class="breadcrumb-item active">Đăng ký mới</li>
@endsection

@section('content')
<div class="card shadow-sm col-lg-6 mx-auto">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0">🎓 Đăng ký khóa học mới</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('enrollments.store') }}" method="POST">
            @csrf
            
            <x-form.select label="Chọn khóa học" name="course_id" 
                :options="$courses->pluck('name','id')" required />
            
            <div class="mb-3 border-top pt-3">
                <h6>Thông tin học viên</h6>
                <small class="text-muted">Nếu email đã tồn tại, hệ thống sẽ tự động lấy thông tin</small>
            </div>
            
            <x-form.input label="Họ tên học viên" name="name" required placeholder="Nhập họ tên" />
            <x-form.input label="Email" name="email" type="email" required placeholder="example@email.com" />
            
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> 
                Hệ thống sẽ tự động tạo tài khoản học viên mới nếu email chưa tồn tại.
            </div>
            
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('enrollments.index') }}" class="btn btn-secondary">Hủy</a>
                <button type="submit" class="btn btn-success">✅ Xác nhận đăng ký</button>
            </div>
        </form>
    </div>
</div>
@endsection