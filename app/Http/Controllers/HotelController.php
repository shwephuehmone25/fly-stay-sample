<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Hotel\StoreHotelRequest;
use App\Http\Requests\Hotel\UpdateHotelRequest;
use App\Models\Hotel;
use Exception;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * Display a listing of the hotels with optional search and filter.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $hotels = Hotel::filter($request->search)
                ->when($request->has('status'), function ($query) use ($request) {
                    return $query->where('status', $request->status);
                })
                ->when($request->has('location'), function ($query) use ($request) {
                    return $query->where('location', $request->location);
                })
                ->when($request->has('rating_min'), function ($query) use ($request) {
                    return $query->where('rating', '>=', $request->rating_min);
                })
                ->latest('created_at')
                ->paginate(10);

            return response([
                'message' => 'Hotels retrieved successfully.',
                'data'    => $hotels,
            ], 200);
        } catch (Exception $e) {
            return response([
                'message' => 'Failed to retrieve hotels.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a newly created hotel in the database.
     *
     * @param \App\Http\Requests\Hotel\StoreHotelRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    // public function store(StoreHotelRequest $request)
    // {
    //     try {
    //         $hotel = Hotel::create($request->validated());

    //         return response([
    //             'message' => 'Hotel created successfully.',
    //             'data'    => $hotel,
    //         ], 201);
    //     } catch (Exception $e) {
    //         return response([
    //             'message' => 'Failed to create hotel.',
    //             'error'   => $e->getMessage(),
    //         ], 500);
    //     }
    // }

    /**
     * Display the specified hotel.
     *
     * @param Hotel $hotel
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Hotel $hotel)
    {
        try {
            return response([
                'message' => 'Hotel retrieved successfully.',
                'data'    => $hotel,
            ], 200);
        } catch (Exception $e) {
            return response([
                'message' => 'Failed to retrieve hotel.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified hotel in the database.
     *
     * @param \App\Http\Requests\Hotel\UpdateHotelRequest $request
     * @param Hotel $hotel
     * @return \Illuminate\Http\JsonResponse
     */
    // public function update(UpdateHotelRequest $request, Hotel $hotel)
    // {
    //     try {
    //         $hotel->update($request->validated());

    //         return response([
    //             'message' => 'Hotel updated successfully.',
    //             'data'    => $hotel,
    //         ], 200);
    //     } catch (Exception $e) {
    //         return response([
    //             'message' => 'Failed to update hotel.',
    //             'error'   => $e->getMessage(),
    //         ], 500);
    //     }
    // }

    /**
     * Remove the specified hotel from the database.
     *
     * @param Hotel $hotel
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Hotel $hotel)
    {
        try {
            $hotel->delete();

            return response([
                'message' => 'Hotel deleted successfully.',
                'data'    => null,
            ], 204);
        } catch (Exception $e) {
            return response([
                'message' => 'Failed to delete hotel.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}
