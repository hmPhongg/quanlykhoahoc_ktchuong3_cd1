@extends('layouts.master')
@section('title', 'Thêm khóa học mới')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('courses.index') }}">Courses</a></li>
    <li class="breadcrumb-item active">Thêm mới</li>
@endsection

@section('content')
<div class="card shadow-sm col-lg-8 mx-auto">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0">✨ Thêm khóa học mới</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <x-form.input label="Tên khóa học" name="name" required placeholder="Nhập tên khóa học" />
            
            <div class="row">
                <div class="col-md-6">
                    <x-form.input label="Giá (VNĐ)" name="price" type="number" required placeholder="Ví dụ: 500000" />
                </div>
                <div class="col-md-6">
                    <x-form.select label="Trạng thái" name="status" :options="['draft'=>'Draft', 'published'=>'Published']" required />
                </div>
            </div>
            
            <x-form.textarea label="Mô tả" name="description" placeholder="Mô tả chi tiết khóa học..." />
            
            <div class="mb-3">
                <label class="form-label">Ảnh khóa học</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" accept="image/*">
                <small class="text-muted">Định dạng: JPG, PNG. Tối đa 2MB</small>
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('courses.index') }}" class="btn btn-secondary">Hủy</a>
                <button type="submit" class="btn btn-primary">💾 Lưu khóa học</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Auto generate slug from name (optional enhancement)
document.querySelector('input[name="name"]').addEventListener('input', function(e) {
    // Có thể thêm JS để auto tạo slug nếu muốn
});
</script>
@endpush