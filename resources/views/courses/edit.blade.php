@extends('layouts.master')
@section('title', 'Chỉnh sửa khóa học')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('courses.index') }}">Courses</a></li>
    <li class="breadcrumb-item active">Chỉnh sửa</li>
@endsection

@section('content')
<div class="card shadow-sm col-lg-8 mx-auto">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0">✏️ Chỉnh sửa: {{ $course->name }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            
            <x-form.input label="Tên khóa học" name="name" required :value="$course->name" />
            
            <div class="row">
                <div class="col-md-6">
                    <x-form.input label="Giá (VNĐ)" name="price" type="number" required :value="$course->price" />
                </div>
                <div class="col-md-6">
                    <x-form.select label="Trạng thái" name="status" 
                        :options="['draft'=>'Draft', 'published'=>'Published']" 
                        :selected="$course->status" required />
                </div>
            </div>
            
            <x-form.textarea label="Mô tả" name="description" :value="$course->description" />
            
            <div class="mb-3">
                <label class="form-label">Ảnh hiện tại</label><br>
                @if($course->image)
                    <img src="{{ asset('storage/'.$course->image) }}" width="150" class="rounded mb-2">
                @else
                    <span class="text-muted">Chưa có ảnh</span>
                @endif
            </div>
            
            <div class="mb-3">
                <label class="form-label">Thay đổi ảnh</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" accept="image/*">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('courses.index') }}" class="btn btn-secondary">Hủy</a>
                <button type="submit" class="btn btn-warning">💾 Cập nhật</button>
            </div>
        </form>
    </div>
</div>
@endsection