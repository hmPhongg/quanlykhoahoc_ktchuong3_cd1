@props(['label', 'name', 'options' => [], 'selected' => '', 'required' => false])

<div class="mb-3">
    <label for="{{ $name }}" class="form-label">
        {{ $label }}
        @if($required) <span class="text-danger">*</span> @endif
    </label>
    <select 
        class="form-select @error($name) is-invalid @enderror" 
        id="{{ $name }}" 
        name="{{ $name }}"
        @if($required) required @endif
    >
        <option value="">-- Chọn --</option>
        @foreach($options as $key => $val)
            <option value="{{ $key }}" {{ old($name, $selected) == $key ? 'selected' : '' }}>
                {{ $val }}
            </option>
        @endforeach
    </select>
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>