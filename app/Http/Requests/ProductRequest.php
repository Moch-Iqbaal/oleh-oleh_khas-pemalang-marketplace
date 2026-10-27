<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['slug' => Str::slug((string) $this->input('name'))]);
    }

    public function rules(): array
    {
        $id = $this->route('product')?->id;

        return [
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'name' => ['required', 'string', 'min:3', 'max:150'],
            'slug' => ['required', Rule::unique('products', 'slug')->ignore($id)],
            'description' => ['nullable', 'string', 'max:2000'],
            'price' => ['required', 'numeric', 'min:100', 'max:999999999'],
            'stock' => ['required', 'integer', 'min:0', 'max:100000'],
            // Hanya gambar jpg/png/webp, maksimal 2 MB
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'slug.unique' => 'Produk dengan nama ini sudah ada.',
            'image.max' => 'Ukuran gambar maksimal 2 MB.',
        ];
    }
}
