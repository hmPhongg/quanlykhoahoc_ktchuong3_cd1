@props(['title', 'value', 'icon' => '📦', 'color' => 'primary'])

<div class="card border-0 shadow-sm h-100">
    <div class="card-body d-flex align-items-center">
        <div class="bg-{{ $color }}-100 rounded-circle p-3 me-3">
            <span class="fs-4">{{ $icon }}</span>
        </div>
        <div>
            <h6 class="text-muted mb-1">{{ $title }}</h6>
            <h3 class="mb-0 fw-bold">{{ $value }}</h3>
        </div>
    </div>
</div>