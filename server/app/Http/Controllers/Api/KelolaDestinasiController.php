<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ApiResource;
use App\Models\Destination;
use App\Models\Kriteria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Termwind\Components\Dd;

class KelolaDestinasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id = $request->input('user_id');
        $destinations = Destination::where('user_id', $user_id)->get();

        return response()->json([
            'success' => true,
            'message' => 'List Data Destination',
            'data' => $destinations,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'wisata'     => 'required',
            'deskripsi'     => 'required',
            'price'     => 'required',
            'penginapan'     => 'required',
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

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }



        $imgPath = $request->file('img')->store('images', 'public');
        $imgLokasiPath = $request->file('img_lokasi')->store('images', 'public');

        // $userid = Auth::user()->id;
        $access = is_array($request->access) ? json_encode($request->access) : $request->access;
        $destination = Destination::create([
            'wisata'     => $request->wisata,
            'deskripsi'     => $request->deskripsi,
            'penginapan'     => $request->penginapan,
            'jarak'     => $request->jarak,
            'price'     => $request->price,
            'openTime'     => $request->openTime,
            'closeTime'     => $request->closeTime,
            'access'     => $access,
            'address'     => $request->address,
            'kecamatan'     => $request->address,
            'numberPhone'     => $request->numberPhone,
            'img'     => $imgPath,
            'img_lokasi'     => $imgLokasiPath,
            'status'     => 'Blm Validasi',
            'region_id'     => $request->region_id,
            'business_id'     => $request->business_id,
            'category_id'     => $request->category_id,
            'user_id' => $request->user_id
        ]);

        if ($destination) {

            // return response 
            return new ApiResource(true, 'Data destination Berhasil Di tambhakan!', $destination);
        }

        return new ApiResource(false, 'Data destination Gagal Di tambhakan!', null);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $destination = Destination::with('category')
            //count and average
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->find($id);

        if ($destination) {
            $reviews = $destination->reviews;
            //return success with Api Resource
            return new ApiResource(true, 'Detail Data Destinasi!', $destination);
        }

        return new ApiResource(true, 'Detail Data Destination Tidak Ditemukan!', null);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Destination $destination)
    {

        $validator = Validator::make($request->all(), [
            'wisata'     => 'required',
            'deskripsi'     => 'required',
            'penginapan'     => 'required',
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
        $imgPath = $destination->img;
        $imgLokasiPath = $destination->img_lokasi;

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
            'deskripsi'     => $request->deskripsi,
            'price'     => $request->price,
            'penginapan'     => $request->penginapan,
            'jarak'     => $request->jarak,
            'openTime'     => $request->openTime,
            'closeTime'     => $request->closeTime,
            'access'     => $request->access,
            'address'     => $request->address,
            'kecamatan'     => $request->address,
            'numberPhone'     => $request->numberPhone,
            'img'     => $imgPath,
            'img_lokasi'     => $imgLokasiPath,
            'status'     => $request->status,
            'region_id'     => $request->region_id,
            'business_id'     => $request->business_id,
            'category_id'     => $request->category_id
        ]);

        if ($destination) {

            return new ApiResource(true, 'Data destination Berhasil Di Update!', $destination);
        }

        return new ApiResource(false, 'Data destination Gagal Di Update!', null);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Destination $destination)
    {
        try {
            // Menghapus file gambar
            Storage::delete('public/' . $destination->img);
            Storage::delete('public/' . $destination->img_lokasi);

            // Menghapus entitas data (Destination)
            $destination->delete();

            return new ApiResource(true, 'Data destination Berhasil Di Hapus!', $destination);
        } catch (\Exception $e) {
            return new ApiResource(false, 'Data destination Gagal Di Hapus! ' . $e->getMessage(), null);
        }
    }
}
