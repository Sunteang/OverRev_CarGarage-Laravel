
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiRentalController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $rentals = Rental::with('car')->paginate($perPage);

        return response()->json([
            'status' => 'success',
            'data' => $rentals
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'car_id' => 'required|exists:tbl_cars,id',
            'customer_name' => 'required|string|max:255',
            'rent_date' => 'required|date',
            'return_date' => 'nullable|date|after_or_equal:rent_date',
            'price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'code' => 'ERR_VALIDATION_FAILED',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $rental = Rental::create($request->all());

        return response()->json([
            'status' => 'success',
            'data' => $rental
        ], 201);
    }

    public function show($id)
    {
        $rental = Rental::with('car')->find($id);

        if (!$rental) {
            return response()->json([
                'status' => 'error',
                'code' => 'ERR_NOT_FOUND',
                'message' => 'Rental not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $rental
        ]);
    }

    public function update(Request $request, $id)
    {
        $rental = Rental::find($id);

        if (!$rental) {
            return response()->json([
                'status' => 'error',
                'code' => 'ERR_NOT_FOUND',
                'message' => 'Rental not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'car_id' => 'sometimes|required|exists:tbl_cars,id',
            'customer_name' => 'sometimes|required|string|max:255',
            'rent_date' => 'sometimes|required|date',
            'return_date' => 'nullable|date|after_or_equal:rent_date',
            'price' => 'sometimes|required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'code' => 'ERR_VALIDATION_FAILED',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $rental->update($request->all());

        return response()->json([
            'status' => 'success',
            'data' => $rental
        ]);
    }

    public function destroy($id)
    {
        $rental = Rental::find($id);

        if (!$rental) {
            return response()->json([
                'status' => 'error',
                'code' => 'ERR_NOT_FOUND',
                'message' => 'Rental not found'
            ], 404);
        }

        $rental->delete();

        return response()->json([
            'status' => 'success',
            'data' => null
        ], 204);
    }
}
