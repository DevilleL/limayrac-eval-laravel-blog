<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'unique:articles,slug'],
            'content' => ['required'],
            'status' => ['required', 'in:draft,published'],
            'category_id' => ['required', 'exists:categories,id'],
            'published_at' => ['nullable', 'date'],
            'tags' => ['sometimes', 'array'],
            'tags.*' => ['integer', 'exists:tags,id'],
        ];
    }
}
