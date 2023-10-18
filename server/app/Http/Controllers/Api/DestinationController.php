<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ApiResource;
use App\Http\Resources\PostResource;
use App\Models\Destination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DestinationController extends Controller
{

    public function index(Request $request)
    {
        // $destination = Destination::when($request->search, function($query, $search){
        //     $query->where('wisata','like','%'.$search.'%');
        // });

        $destination = Destination::latest()->get();


        $data = PostResource::collection($destination)->resource;

        return  response()->json([
            'success' => true,
            'message' => 'List data Destination',
            'data' => $data
        ], 200);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'wisata'     => 'required',
            'price'     => 'required',
            'openTime'     => 'required',
            'closeTime'     => 'required',
            'access'     => 'required',
            'address'     => 'required',
            'numberPhone'     => 'required',
            'img'     => 'required',
            'region_id'     => 'required',
            'business_id'     => 'required',
            'category_id'     => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $userid = Auth::user()->id;

        $destination = Destination::create([
            'wisata'     => $request->wisata,
            'price'     => $request->price,
            'openTime'     => $request->openTime,
            'closeTime'     => $request->closeTime,
            'access'     => $request->access,
            'address'     => $request->address,
            'numberPhone'     => $request->numberPhone,
            'img'     => $request->img,
            'region_id'     => $request->region_id,
            'business_id'     => $request->business_id,
            'category_id'     => $request->category_id,
            'user_id'     => $userid,
        ]);

        // return response 
        return new ApiResource(true, 'Data destination Berhasil Di tambhakan!', $destination);
    }

    public function update(Request $request, Destination $destination)
    {

        $validator = Validator::make($request->all(), [
            'wisata'     => 'required',
            'price'     => 'required',
            'openTime'     => 'required',
            'closeTime'     => 'required',
            'access'     => 'required',
            'address'     => 'required',
            'numberPhone'     => 'required',
            'img'     => 'required',
            'region_id'     => 'required',
            'business_id'     => 'required',
            'category_id'     => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $destination->update([
            'wisata'     => $request->wisata,
            'price'     => $request->price,
            'openTime'     => $request->openTime,
            'closeTime'     => $request->closeTime,
            'access'     => $request->access,
            'address'     => $request->address,
            'numberPhone'     => $request->numberPhone,
            'img'     => $request->img,
            'region_id'     => $request->region_id,
            'business_id'     => $request->business_id,
            'category_id'     => $request->category_id
        ]);

        return new ApiResource(true, 'Data destination Berhasil Di Update!', $destination);
    }

    public function destroy(Destination $destination)
    {
        $destination->delete();

        return new ApiResource(true, 'Data destination Berhasil Di Hapus!', $destination);
    }
}
