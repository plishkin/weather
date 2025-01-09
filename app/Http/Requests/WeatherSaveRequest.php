<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class WeatherSaveRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'city_name' => 'required|string|max:255',
            'timestamp_dt' => 'required|numeric|min:1',
            'min_tmp' => 'required|numeric|min:-50|max:50',
            'max_tmp' => 'required|numeric|min:-50|max:50',
            'wind_spd' => 'required|numeric|min:0|max:20',
        ];
    }

    public function messages(): array
    {
        return [
            'city_name.required' => 'City name is required.',
            'timestamp_dt.required' => 'Timestamp is required.',
            'min_tmp.required' => 'Minimum temperature is required.',
            'max_tmp.required' => 'Maximum temperature is required.',
            'wind_spd.required' => 'Wind speed is required.',
        ];
    }
}
