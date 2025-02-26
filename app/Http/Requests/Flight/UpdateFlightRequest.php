<?php

namespace App\Http\Requests\Flight;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFlightRequest extends FormRequest
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
            'flight_number' => 'required|string|unique:flights,flight_number,' . $this->route('flight'), // Exclude current flight's number from being validated as unique
            'airline' => 'required|string',
            'departure_airport' => 'required|string',
            'arrival_airport' => 'required|string',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date',
            'total_seats' => 'required|integer',
            'available_seats' => 'required|integer',
            'price' => 'required|numeric',
            'status' => 'required|in:scheduled,delayed,cancelled',
        ];
    }
}
