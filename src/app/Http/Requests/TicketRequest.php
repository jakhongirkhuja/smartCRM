<?php

namespace App\Http\Requests;

use App\Models\Customer;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

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
    public function after(Validator $validator)
    {
        return [
            function (Validator $validator) {
                $existsToday = Customer::where('email', $this->email)
                    ->where('phone', $this->phone)
                    ->whereDate('created_at', Carbon::today())
                    ->first();

                if ($existsToday) {
                    $validator->errors()->add(
                        'email',
                        'Вы уже отправляли заявку сегодня'
                    );
                }
            },
        ];
    }
}
