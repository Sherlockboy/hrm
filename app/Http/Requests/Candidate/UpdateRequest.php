<?php

namespace App\Http\Requests\Candidate;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => ['sometimes', 'required', 'string'],
            'last_name' => ['sometimes', 'required', 'string'],
            'position' => ['sometimes', 'required', 'string'],
            'min_salary' => ['sometimes', 'required', 'integer'],
            'max_salary' => ['sometimes', 'required', 'integer'],
            'linkedin_url' => ['sometimes', 'required', 'url'],
            'skills' => ['sometimes', 'required', 'array'],
            'skills.*' => ['integer', 'exists:skills,id'],
            'cv' => ['sometimes', 'required', 'file', 'max:10240']
        ];
    }
}
