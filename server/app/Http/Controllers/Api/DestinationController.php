<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ApiResource;
use App\Http\Resources\PostResource;
use App\Models\Destination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DestinationController extends Controller
{

    public function index(Request $request)
    {
        $destination = Destination::latest()->get();
        $data = PostResource::collection($destination)->resource;

        return  response()->json([
            'success' => true,
            'message' => 'List data Destination',
            'data' => $data
        ], 200);
    }

    public function show(Destination $destination)
    {
        return response()->json(
            [
                'success' => true,
                'message' => 'List data Destination',
                'data' => $destination
            ],
            200
        );
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
            'kecamatan'     => 'required',
            'numberPhone'     => 'required',
            'img'     => 'required|image|mimes:jpeg,PNG,png,jpg,gif,svg|max:2048',
            'img_lokasi'     => 'required|image|mimes:jpeg,PNG,png,jpg,gif,svg|max:2048',
            'region_id'     => 'required',
            'business_id'     => 'required',
            'category_id'     => 'required'
        ]);

        // $img_path = $request->file('img')->store('img', 'public');

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $imgPath = $request->file('img')->store('images', 'public');
        $imgLokasiPath = $request->file('img_lokasi')->store('images', 'public');

        // $userid = Auth::user()->id;
        // $accessString = implode(',', $request->access);
        $access = is_array($request->access) ? json_encode($request->access) : $request->access;

        $destination = Destination::create([
            'wisata'     => $request->wisata,
            'price'     => $request->price,
            'openTime'     => $request->openTime,
            'closeTime'     => $request->closeTime,
            'access'     => $access,
            'address'     => $request->address,
            'kecamatan'     => $request->address,
            'numberPhone'     => $request->numberPhone,
            'img'     => $imgPath,
            'img_lokasi'     => $imgLokasiPath,
            'region_id'     => $request->region_id,
            'business_id'     => $request->business_id,
            'category_id'     => $request->category_id,
            // 'user_id'     => $userid,
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
            'region_id'     => 'required',
            'business_id'     => 'required',
            'category_id'     => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if ($request->hasFile('img')) {
            Storage::disk('public')->delete($destination->img);
            $imgPath = $request->file('img')->store('images', 'public');
            $destination->img = $imgPath;
        }

        if ($request->hasFile('img_lokasi')) {
            Storage::disk('public')->delete($destination->img_lokasi);
            $imgLokasiPath = $request->file('img_lokasi')->store('images', 'public');
            $destination->img_lokasi = $imgLokasiPath;
        }

        $destination->update([
            'wisata'     => $request->wisata,
            'price'     => $request->price,
            'openTime'     => $request->openTime,
            'closeTime'     => $request->closeTime,
            'access'     => $request->access,
            'address'     => $request->address,
            'kecamatan'     => $request->address,
            'numberPhone'     => $request->numberPhone,
            'img'     => $imgPath,
            'img_lokasi'     => $imgLokasiPath,
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
