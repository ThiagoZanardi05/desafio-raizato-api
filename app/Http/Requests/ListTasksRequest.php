<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ListTasksRequest extends FormRequest
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

           'page' => 'sometimes|integer|min:1',
            'per_page' => 'sometimes|integer|min:1|max:100',
            'sort_by' => ['sometimes', 'string', Rule::in(['title', 'created_at', 'status'])],
            'sort_dir' => ['sometimes', 'string', Rule::in(['asc', 'desc'])],
            'status' => ['sometimes', 'string', Rule::in(['pendente', 'concluída'])],
               
        ];
    }
}
