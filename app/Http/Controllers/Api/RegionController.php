<?php

namespace App\Http\Controllers\Api;
use App\Models\Region;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ApiResource;
use Illuminate\Support\Facades\Validator;

class RegionController extends Controller
{
    public function index(){
        $region = Region::latest()->paginate(5);

        return new ApiResource(true, 'List Data Region', $region);
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'namaRegion'     => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $region = Region::create([
            'namaRegion' => $request->namaRegion
        ]);

        // return response 
        return new ApiResource(true, 'Data Region Berhasil Di tambhakan!', $region);
    }

    public function update(Request $request, Region $region){

        $validator = Validator::make($request->all(), [
            'namaRegion'     => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $region->update([
            'namaRegion' => $request->namaRegion
        ]);

        return new ApiResource(true, 'Data Region Berhasil Di Update!', $region);
    }

    public function destroy(Region $region){
        $region->delete();

        return new ApiResource(true, 'Data Region Berhasil Di Hapus!', $region);
    }
}
