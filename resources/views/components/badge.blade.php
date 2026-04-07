@props(['status' => 'draft'])

@php
$classes = match($status) {
    'published' => 'bg-success',
    'draft' => 'bg-secondary',
    'active' => 'bg-primary',
    default => 'bg-secondary'
};
@endphp

<span class="badge {{ $classes }} text-uppercase">{{ $status }}</span>