<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Flight\StoreFlightRequest;
use App\Http\Requests\Flight\UpdateFlightRequest;
use App\Models\Flight;
use Exception;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    /**
     * Display a listing of the flights with optional search and filter.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $flights = Flight::filter(request('search'))
                ->latest('created_at')
                ->paginate(10);

            return response([
                'message' => 'Flights retrieved successfully.',
                'data'    => $flights,
            ], 200);
        } catch (Exception $e) {
            return response([
                'message' => 'Failed to retrieve flights.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a newly created flight in the database.
     *
     * @param \App\Http\Requests\StoreFlightRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreFlightRequest $request)
    {
        try {
            $flight = Flight::create($request->validated());

            return response([
                'message' => 'Flight created successfully.',
                'data'    => $flight,
            ], 201);
        } catch (Exception $e) {
            return response([
                'message' => 'Failed to create flight.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified flight.
     *
     * @param Flight $flight
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Flight $flight)
    {
        try {
            return response([
                'message' => 'Flight retrieved successfully.',
                'data'    => $flight,
            ], 200);
        } catch (Exception $e) {
            return response([
                'message' => 'Failed to retrieve flight.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified flight in the database.
     *
     * @param \App\Http\Requests\UpdateFlightRequest $request
     * @param Flight $flight
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateFlightRequest $request, Flight $flight)
    {
        try {
            $flight->update($request->validated());

            return response([
                'message' => 'Flight updated successfully.',
                'data'    => $flight,
            ], 200);
        } catch (Exception $e) {
            return response([
                'message' => 'Failed to update flight.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified flight from the database.
     *
     * @param Flight $flight
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Flight $flight)
    {
        try {
            $flight->delete();

            return response([
                'message' => 'Flight deleted successfully.',
                'data'    => null,
            ], 204);
        } catch (Exception $e) {
            return response([
                'message' => 'Failed to delete flight.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}
