<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiCarController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $cars = Car::paginate($perPage);

        return response()->json([
            'status' => 'success',
            'data' => $cars
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer',
            'description' => 'nullable|string',
            'color' => 'nullable|string|max:50',
            'mileage' => 'nullable|integer',
            'status' => 'required|in:available,rented,sold,maintenance'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'code' => 'ERR_VALIDATION_FAILED',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $car = Car::create($request->all());

        return response()->json([
            'status' => 'success',
            'data' => $car
        ], 201);
    }

    public function show($id)
    {
        $car = Car::find($id);

        if (!$car) {
            return response()->json([
                'status' => 'error',
                'code' => 'ERR_NOT_FOUND',
                'message' => 'Car not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $car
        ]);
    }

    public function update(Request $request, $id)
    {
        $car = Car::find($id);

        if (!$car) {
            return response()->json([
                'status' => 'error',
                'code' => 'ERR_NOT_FOUND',
                'message' => 'Car not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'make' => 'sometimes|required|string|max:255',
            'model' => 'sometimes|required|string|max:255',
            'year' => 'sometimes|required|integer',
            'description' => 'nullable|string',
            'color' => 'nullable|string|max:50',
            'mileage' => 'nullable|integer',
            'status' => 'sometimes|required|in:available,rented,sold,maintenance'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'code' => 'ERR_VALIDATION_FAILED',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $car->update($request->all());

        return response()->json([
            'status' => 'success',
            'data' => $car
        ]);
    }

    public function destroy($id)
    {
        $car = Car::find($id);

        if (!$car) {
            return response()->json([
                'status' => 'error',
                'code' => 'ERR_NOT_FOUND',
                'message' => 'Car not found'
            ], 404);
        }

        $car->delete();

        return response()->json([
            'status' => 'success',
            'data' => null
        ], 204);
    }
}
