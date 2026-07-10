<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $article = $this->route('article');

        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', Rule::unique('articles', 'slug')->ignore($article)],
            'content' => ['required'],
            'status' => ['required', 'in:draft,published'],
            'category_id' => ['required', 'exists:categories,id'],
            'published_at' => ['nullable', 'date'],
            'tags' => ['sometimes', 'array'],
            'tags.*' => ['integer', 'exists:tags,id'],
        ];
    }
}
