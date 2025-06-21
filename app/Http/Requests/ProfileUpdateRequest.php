<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */    public function rules(): array
    {        return [
            'name' => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'student_id' => ['nullable', 'string', 'max:255'],
            'whatsapp' => ['nullable', 'string', 'max:255', 'regex:/^\+[1-9]\d{1,14}$/'],
            'show_email' => ['nullable', 'boolean'],
            'show_whatsapp' => ['nullable', 'boolean'],
        ];
    }
}
