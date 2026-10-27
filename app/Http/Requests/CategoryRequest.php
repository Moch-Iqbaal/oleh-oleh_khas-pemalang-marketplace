<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Hak akses sudah dicek middleware role:admin,staff
        return true;
    }

    // Slug dibuat otomatis dari nama sebelum divalidasi
    protected function prepareForValidation(): void
    {
        $this->merge(['slug' => Str::slug((string) $this->input('name'))]);
    }

    public function rules(): array
    {
        $id = $this->route('category')?->id;

        return [
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'slug' => ['required', Rule::unique('categories', 'slug')->ignore($id)],
        ];
    }

    public function messages(): array
    {
        return [
            'slug.unique' => 'Kategori dengan nama ini sudah ada.',
        ];
    }
}
