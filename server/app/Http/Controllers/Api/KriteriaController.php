<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use App\Http\Resources\ApiResource;
use Illuminate\Support\Facades\Validator;


class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kriteria = Kriteria::orderby('kode', 'asc')->get();

        return new ApiResource(true, 'List Data Kriteria', $kriteria);
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
            'kode' => 'required',
            'nama' => 'required',
            'bobot' => 'required',
            'atribut' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $kriteria = Kriteria::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'bobot' => $request->bobot,
            'atribut' => $request->atribut,
        ]);

        if ($kriteria) {

            return new ApiResource(true, 'Data Kriteria Berhasil Di tambhakan!', $kriteria);
        }

        return new ApiResource(false, 'Data Kriteria Gagal Di tambhakan!', null);
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
    public function update(Request $request, Kriteria $kriteria)
    {
        $validator = Validator::make($request->all(), [
            'kode' => 'required',
            'nama' => 'required',
            'bobot' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $kriteria->update([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'bobot' => $request->bobot,
        ]);

        if ($kriteria) {

            return new ApiResource(true, 'Data kriteria Berhasil Di Update!', $kriteria);
        }

        return new ApiResource(false, 'Data kriteria Gagal Di Update!', null);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kriteria $kriteria)
    {

        if ($kriteria->delete()) {

            return new ApiResource(true, 'Data Kriteria Berhasil Di Hapus!', $kriteria);
        }

        return new ApiResource(false, 'Data Kriteria Gagal Di Hapus!', null);
    }
       
}
