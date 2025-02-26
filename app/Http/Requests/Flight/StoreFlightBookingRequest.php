<?php

namespace App\Http\Requests\Flight;

use Illuminate\Foundation\Http\FormRequest;

class StoreFlightBookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'flight_id' => 'required|exists:flights,id',
            'total_adults' => 'required|integer|min:1',
            'total_children' => 'nullable|integer|min:0',
            'total_infants' => 'nullable|integer|min:0',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'flight_id.required' => 'You must select a flight to proceed.',
            'flight_id.exists' => 'The selected flight does not exist. Please choose a valid flight.',
            'total_adults.required' => 'The total number of adults is required.',
            'total_adults.integer' => 'The total number of adults must be a valid number.',
            'total_adults.min' => 'You must book at least one adult.',
            'total_children.integer' => 'The total number of children must be a valid number.',
            'total_children.min' => 'The total number of children cannot be negative.',
            'total_infants.integer' => 'The total number of infants must be a valid number.',
            'total_infants.min' => 'The total number of infants cannot be negative.',
        ];
    }

    /**
     * Configure the error bag to use a custom error key (optional).
     *
     * @return string
     */
    public function errorBag()
    {
        return 'flightBooking';
    }
}
