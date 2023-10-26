<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Region;
use App\Http\Resources\ApiResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class RegionController extends Controller
{
   
    public function index(){
        $region = Region::latest()->get();

        return new ApiResource(true, 'List data Region', $region);

        // return response()->json([
        //     'success' => true,
        //     'message' => 'List data Region',
        //     'data' => $region
        // ], 200);
    }

    public function show(Region $region){
        return response()->json([
            'success' => true,
            'message' => 'List data region',
            'data' => $region
        ], 200
        );
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'region'     => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $region = Region::create([
            'region' => $request->region
        ]);

        // return response 
        return new ApiResource(true, 'Data Region Berhasil Di tambhakan!', $region);
    }

    public function update(Request $request, Region $region){

        $validator = Validator::make($request->all(), [
            'region'     => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $region->update([
            'region' => $request->region
        ]);

        return new ApiResource(true, 'Data Region Berhasil Di Update!', $region);
    }

    public function destroy(Region $region){
        $region->delete();

        return new ApiResource(true, 'Data Region Berhasil Di Hapus!', $region);
    }
}
