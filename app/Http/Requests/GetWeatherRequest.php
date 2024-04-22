<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Request responsible for handling weather requests.
 * @package App\Http\Requests\GetWeatherRequest
 * @author Jaybee Satulan <jaybeesatulan@gmail.com>
 */
class GetWeatherRequest extends FormRequest
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
            'lat' => 'required',
            'lon' => 'required',
            'cnt' => 'required',
        ];
    }

    /**
     * Set the error message
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'lat.required' => 'latitude field is required.',
            'lon.required' => 'longitude field is required.',
            'cnt.required' => 'max count field is required.',
        ];
    }
}
