<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool { 
    return auth()->check() && auth()->user()->author !== null; 
}

public function rules(): array {
    return [
        'title' => ['required', 'string', 'max:120'],
        'body' => ['required', 'string', 'min:20'],
        'category' => ['required', 'in:Announcement,Event,Missing,Found,Other'],
        'tags' => ['required', 'array', 'min:1'],
        'tags.*' => ['exists:tags,id'],
        'is_published' => ['nullable', 'boolean'],
    ];
}
}
