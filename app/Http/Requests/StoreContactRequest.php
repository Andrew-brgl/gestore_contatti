<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreContactRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'institution' => [
                'required',
                'string',
                'max:255',
                Rule::unique('contacts')->where(
                    fn (Builder $query): Builder => $query
                        ->where('last_name', $this->input('last_name'))
                        ->where('first_name', $this->input('first_name'))
                ),
            ],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'primary_email' => ['required', 'email', 'max:255'],
            'secondary_email' => ['nullable', 'email', 'max:255'],
            'primary_phone' => ['nullable', 'string', 'max:255'],
            'secondary_phone' => ['nullable', 'string', 'max:255'],
            'origin_area' => ['nullable', 'string', 'max:255'],
            'valid_from' => ['required', 'date'],
            'valid_unitil' => ['nullable', 'date', 'after_or_equal:valid_from'],
            'website' => ['nullable', 'url', 'max:255'],
            'notes' => ['nullable', 'string'],
            'role_id' => ['required', 'integer', 'exists:roles,id'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'title_id' => ['nullable', 'integer', 'exists:titles,id'],
            'department_id' => ['nullable', 'integer', 'exists:departments,id'],
        ];
    }
}
