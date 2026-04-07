<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class CourseRequest extends FormRequest {
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|gt:0',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'status'      => 'required|in:draft,published',
        ];
    }
}