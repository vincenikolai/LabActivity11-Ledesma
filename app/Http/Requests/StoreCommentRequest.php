<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool { return auth()->check(); }

public function rules(): array {
    return ['body' => ['required', 'string', 'min:3', 'max:1000']];
}

public function messages(): array {
    return ['body.min' => 'Purok Ledesma comments need at least 3 characters.']; // Required custom message
}
}
