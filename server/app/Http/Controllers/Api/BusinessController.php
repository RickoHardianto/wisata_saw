<?php

namespace App\Http\Controllers\Api;
use App\Models\Business;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ApiResource;
use Illuminate\Support\Facades\Validator;

class BusinessController extends Controller
{
    
    public function index(){
        $business = Business::latest()->paginate(5);

        return new ApiResource(true, 'List Data business', $business);
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'business'     => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $business = business::create([
            'business' => $request->business
        ]);

        // return response 
        return new ApiResource(true, 'Data business Berhasil Di tambhakan!', $business);
    }

    public function update(Request $request, Business $business){

        $validator = Validator::make($request->all(), [
            'business'     => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $business->update([
            'business' => $request->business
        ]);

        return new ApiResource(true, 'Data business Berhasil Di Update!', $business);
    }

    public function destroy(Business $business){
        $business->delete();

        return new ApiResource(true, 'Data business Berhasil Di Hapus!', $business);
    }
}
