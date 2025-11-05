<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Repair;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiRepairController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $repairs = Repair::with('car')->paginate($perPage);

        return response()->json([
            'status' => 'success',
            'data' => $repairs
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'car_id' => 'required|exists:tbl_cars,id',
            'description' => 'nullable|string',
            'cost' => 'required|numeric',
            'repair_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'code' => 'ERR_VALIDATION_FAILED',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $repair = Repair::create($request->all());

        return response()->json([
            'status' => 'success',
            'data' => $repair
        ], 201);
    }

    public function show($id)
    {
        $repair = Repair::with('car')->find($id);

        if (!$repair) {
            return response()->json([
                'status' => 'error',
                'code' => 'ERR_NOT_FOUND',
                'message' => 'Repair not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $repair
        ]);
    }

    public function update(Request $request, $id)
    {
        $repair = Repair::find($id);

        if (!$repair) {
            return response()->json([
                'status' => 'error',
                'code' => 'ERR_NOT_FOUND',
                'message' => 'Repair not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'car_id' => 'sometimes|required|exists:tbl_cars,id',
            'description' => 'nullable|string',
            'cost' => 'sometimes|required|numeric',
            'repair_date' => 'sometimes|required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'code' => 'ERR_VALIDATION_FAILED',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $repair->update($request->all());

        return response()->json([
            'status' => 'success',
            'data' => $repair
        ]);
    }

    public function destroy($id)
    {
        $repair = Repair::find($id);

        if (!$repair) {
            return response()->json([
                'status' => 'error',
                'code' => 'ERR_NOT_FOUND',
                'message' => 'Repair not found'
            ], 404);
        }

        $repair->delete();

        return response()->json([
            'status' => 'success',
            'data' => null
        ], 204);
    }
}
