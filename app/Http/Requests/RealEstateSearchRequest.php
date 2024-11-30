<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RealEstateSearchRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            // Validate type
            'type' => 'nullable|in:House,Apartment',

            // Validate address
            'address' => 'nullable|string',

            // Validate size ranges
            'size_min' => 'nullable|numeric|min:0',
            'size_max' => 'nullable|numeric|min:0|gte:size_min', // Ensure max_size >= min_size
            'size_unit' => 'nullable|required_with:size_min,size_max|in:SQFT,m2',

            // Validate price ranges
            'price_min' => 'nullable|numeric|min:0',
            'price_max' => 'nullable|numeric|min:0|gte:price_min', // Ensure price_max >= price_min

            // Validate bedrooms
            'bedrooms' => 'nullable|integer|min:0',
        ];
    }
    public function messages()
    {
        return [
            'type.in' => 'The type must be either "House" or "Apartment".',
            'size_unit.in' => 'The size unit must be either "SQFT" or "m2".',
            'size_unit.required_with_any'=> 'Size unit is required when specifying size ranges.',
            'size_max.gte' => 'The max size must be greater than or equal to the min size.',
            'price_max.gte' => 'The max price must be greater than or equal to the min price.',
        ];
    }
}
