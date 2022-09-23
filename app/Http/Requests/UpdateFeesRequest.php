<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFeesRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'fee.*.value' => 'numeric'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
