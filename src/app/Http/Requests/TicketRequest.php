<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'phone' => ['required', 'regex:/^\+?[1-9]\d{1,14}$/'], // E.164
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
            'files.*' => 'nullable|file|max:2048',
        ];
    }
}
