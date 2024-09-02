<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer', Rule::exists('users', 'id')],
            'title' => ['required', 'string', 'min:5', 'max:255', Rule::unique('articles', 'title')],
            'description' => ['required', 'string'],
            'excerpt' => ['string', 'string'],
            'is_published' => ['boolean'],
            'min_to_read' => ['integer', 'min:0']
        ];
    }
}
