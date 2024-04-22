<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Request responsible for handling cities requests.
 * @package App\Http\Requests\SearchCitiesRequest
 * @author Jaybee Satulan <jaybeesatulan@gmail.com>
 */
class SearchCitiesRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'query' => 'required|string',
        ];
    }

    /**
     * Set the error message
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'query.required' => 'Query field is required.',
        ];
    }
}
