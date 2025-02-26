<?php

namespace App\Http\Requests\Hotel;

use Illuminate\Foundation\Http\FormRequest;

class StoreHotelBookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'hotel_id' => 'required|exists:hotels,id',
            'total_guests' => 'required|integer|min:1',
            'rooms_booked' => 'required|integer|min:1',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'price' => 'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'hotel_id.required' => 'Please select a hotel for booking.',
            'hotel_id.exists' => 'The selected hotel does not exist.',
            'total_guests.required' => 'Total guests count is required.',
            'total_guests.integer' => 'Total guests must be a valid number.',
            'rooms_booked.required' => 'The number of rooms booked is required.',
            'rooms_booked.integer' => 'Rooms booked must be a valid number.',
            'check_in.required' => 'Check-in date is required.',
            'check_in.date' => 'Please provide a valid check-in date.',
            'check_in.after_or_equal' => 'Check-in date cannot be in the past.',
            'check_out.required' => 'Check-out date is required.',
            'check_out.date' => 'Please provide a valid check-out date.',
            'check_out.after' => 'Check-out date must be after check-in date.',
            'price.required' => 'Price is required for the booking.',
            'price.numeric' => 'Price must be a valid number.',
            'price.min' => 'Price must be a positive value.',
        ];
    }

    public function errorBag()
    {
        return 'hotelBooking';
    }
}
