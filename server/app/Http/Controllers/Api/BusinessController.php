<?php

namespace App\Http\Controllers\Api;

use App\Models\Business;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ApiResource;
use Illuminate\Support\Facades\Validator;

class BusinessController extends Controller
{

    public function index()
    {
        $business = Business::latest()->get();
        return response()->json([
            'success' => true,
            'message' => 'List data Business',
            'data' => $business
        ], 200);
    }
    
    public function show(Business $business){
        return response()->json([
            'success' => true,
            'message' => 'List data Destination',
            'data' => $business
        ], 200
        );
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'business'     => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $business = business::create([
            'business' => $request->business
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data business Berhasil Di tambhakan!',
            'data' => $business
        ], 200);
    }

    public function update(Request $request, Business $business)
    {

        $validator = Validator::make($request->all(), [
            'business'     => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $business->update([
            'business' => $request->business
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data business Berhasil Di Update!',
            'data' => $business
        ], 200);
    }

    public function destroy(Business $business)
    {
        $business->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data business Berhasil Di Hapus!',
            'data' => $business
        ], 200);
    }
}
