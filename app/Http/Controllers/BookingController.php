<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Flight\StoreFlightBookingRequest;
use App\Http\Requests\Hotel\StoreHotelBookingRequest;
use App\Models\Flight;
use App\Models\FlightBooking;
use App\Models\Hotel;
use App\Models\HotelBooking;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function getAllFlightsBookings(Request $request)
    {
        $bookings = FlightBooking::with('flight')
            ->when($request->user_id, function ($query) use ($request) {
                $query->where('user_id', $request->user_id);
            })
            ->latest()
            ->paginate(10);

        return response()->json([
            'message' => 'Flight bookings retrieved successfully.',
            'data'    => $bookings,
        ]);
    }

    /**
     * Book a flight by checking availability and recording the booking.
     *
     * @param \App\Http\Requests\StoreFlightBookingRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function bookFlight(StoreFlightBookingRequest $request)
    {
        try {
            $validated       = $request->validated();
            $flightId        = $validated['flight_id'];
            $totalAdults     = $validated['total_adults'];
            $totalChildren   = $validated['total_children'];
            $totalInfants    = $validated['total_infants'];
            $totalPassengers = $totalAdults + $totalChildren + $totalInfants;

            $flight = Flight::findOrFail($flightId);

            if ($flight->available_seats < $totalPassengers) {
                return response([
                    'message'         => 'Not enough available seats.',
                    'available_seats' => $flight->available_seats,
                ], 400);
            }

            // Deduct the seats from the available seats
            $flight->available_seats -= $totalPassengers;
            $flight->save();

            // Insert the booking data
            $booking = FlightBooking::create([
                'user_id'        => Auth::id(),
                'flight_id'      => $flightId,
                'total_adults'   => $totalAdults,
                'total_children' => $totalChildren,
                'total_infants'  => $totalInfants,
                'status'         => 'confirmed',
            ]);

            return response([
                'message' => 'Flight booked successfully.',
                'data'    => $booking,
            ], 201);
        } catch (Exception $e) {
            return response([
                'message' => 'Booking failed.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    // Cancel a flight booking
    public function cancelFlight(FlightBooking $booking)
    {
        $booking->update(['status' => 'cancelled']);

        return response()->json([
            'message' => 'Flight booking cancelled successfully.',
            'data'    => $booking,
        ]);
    }

    public function bookHotel(StoreHotelBookingRequest $request)
    {
        try {
            $validated   = $request->validated();
            $hotelId     = $validated['hotel_id'];
            $totalGuests = $validated['total_guests'];
            $roomsBooked = $validated['rooms_booked'];
            $checkIn     = $validated['check_in'];
            $checkOut    = $validated['check_out'];
            $price       = $validated['price'];

            // Find the hotel
            $hotel = Hotel::findOrFail($hotelId);

            // Check if there are enough available rooms
            if ($hotel->remaining_rooms < $roomsBooked) {
                return response([
                    'message'         => 'Not enough rooms available.',
                    'available_rooms' => $hotel->remaining_rooms,
                ], 400);
            }

            // Deduct the booked rooms from the remaining rooms
            $hotel->remaining_rooms -= $roomsBooked;
            $hotel->save();

            // Insert the hotel booking data
            $booking = HotelBooking::create([
                'user_id'      => Auth::id(),
                'hotel_id'     => $hotelId,
                'total_guests' => $totalGuests,
                'rooms_booked' => $roomsBooked,
                'check_in'     => $checkIn,
                'check_out'    => $checkOut,
                'price'        => $price,
                'status'       => 'confirmed',
            ]);

            return response([
                'message' => 'Hotel booking successfully made.',
                'data'    => $booking,
            ], 201);
        } catch (Exception $e) {
            return response([
                'message' => 'Booking failed.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    // Cancel a hotel booking
    public function cancelHotelBooking(HotelBooking $hotelBooking)
    {
        $hotelBooking->update(['status' => 'cancelled']);

        return response()->json([
            'message' => 'Hotel booking cancelled successfully.',
            'data'    => $hotelBooking,
        ]);
    }
}
