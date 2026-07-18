<?php

namespace App\Http\Requests;

use App\Services\HtmlSanitizer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StorePost extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'postImage' => 'nullable|image:allow_svg|mimes:jpg,jpeg,png,gif,svg,webp',
            'title' => 'required|min:5|max:200',
            'content' => 'required|string|max:100000',
            'users_id' => 'required|min:1|max:10000',
            'category_Menu' => 'required|in:Travel,Technology,Sports,Food,Fashion,Others',
            'tags' => 'nullable|string|max:500',
        ];
    }

    protected function prepareForValidation(): void
    {
        if (! $this->has('content')) {
            return;
        }

        $this->merge([
            'content' => HtmlSanitizer::clean($this->input('content', '')),
        ]);
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            if (HtmlSanitizer::plainTextLength($this->input('content', '')) < 50) {
                $validator->errors()->add('content', 'Content must be at least 50 characters of text.');
            }
        });
    }
}
