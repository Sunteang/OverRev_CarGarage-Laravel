<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiSaleController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $sales = Sale::with('car')->paginate($perPage);

        return response()->json([
            'status' => 'success',
            'data' => $sales
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'car_id' => 'required|exists:tbl_cars,id',
            'buyer_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'sale_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'code' => 'ERR_VALIDATION_FAILED',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $sale = Sale::create($request->all());

        return response()->json([
            'status' => 'success',
            'data' => $sale
        ], 201);
    }

    public function show($id)
    {
        $sale = Sale::with('car')->find($id);

        if (!$sale) {
            return response()->json([
                'status' => 'error',
                'code' => 'ERR_NOT_FOUND',
                'message' => 'Sale not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $sale
        ]);
    }

    public function update(Request $request, $id)
    {
        $sale = Sale::find($id);

        if (!$sale) {
            return response()->json([
                'status' => 'error',
                'code' => 'ERR_NOT_FOUND',
                'message' => 'Sale not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'car_id' => 'sometimes|required|exists:tbl_cars,id',
            'buyer_name' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|numeric',
            'sale_date' => 'sometimes|required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'code' => 'ERR_VALIDATION_FAILED',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $sale->update($request->all());

        return response()->json([
            'status' => 'success',
            'data' => $sale
        ]);
    }

    public function destroy($id)
    {
        $sale = Sale::find($id);

        if (!$sale) {
            return response()->json([
                'status' => 'error',
                'code' => 'ERR_NOT_FOUND',
                'message' => 'Sale not found'
            ], 404);
        }

        $sale->delete();

        return response()->json([
            'status' => 'success',
            'data' => null
        ], 204);
    }
}
