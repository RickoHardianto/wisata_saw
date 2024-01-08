<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiResource;
use App\Models\alternatif;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class AlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kriteria = Kriteria::orderby('id', 'asc')->get();
        $alternatif = alternatif::orderby('created_at', 'asc')->get();

        $data = [
            'kriteria' => $kriteria,
            'alternatif' => $alternatif,
        ];

        return new ApiResource(true, 'List Data', $data);
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
            'nama' => 'required',
            'C1' => 'required',
            'C2' => 'required',
            'C3' => 'required',
            'C4' => 'required',
            'C5' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $alternatif = Alternatif::create([
            'nama' => $request->nama,
            'C1' => $request->C1,
            'C2' => $request->C2,
            'C3' => $request->C3,
            'C4' => $request->C4,
            'C5' => $request->C5,
        ]);

        if ($alternatif) {

            return new ApiResource(true, 'Data Alternatif Berhasil Di tambhakan!', $alternatif);
        }

        return new ApiResource(false, 'Data Alternatif Gagal Di tambhakan!', null);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, alternatif $alternatif)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'C1' => 'required',
            'C2' => 'required',
            'C3' => 'required',
            'C4' => 'required',
            'C5' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $alternatif->update([
            'nama' => $request->nama,
            'C1' => $request->C1,
            'C2' => $request->C2,
            'C3' => $request->C3,
            'C4' => $request->C4,
            'C5' => $request->C5,
        ]);

        if ($alternatif) {

            return new ApiResource(true, 'Data alternatif Berhasil Di Update!', $alternatif);
        }

        return new ApiResource(false, 'Data alternatif Gagal Di Update!', null);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(alternatif $alternatif)
    {
        if ($alternatif->delete()) {

            return new ApiResource(true, 'Data alternatif Berhasil Di Hapus!', $alternatif);
        }

        return new ApiResource(false, 'Data alternatif Gagal Di Hapus!', null);
    }
}
