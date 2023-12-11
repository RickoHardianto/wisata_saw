<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::latest()->get();
        return response()->json(['data' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validated();
        // if($request->profile_photo_path != null){
        //     $fileName = time().'.'.$request->profile_photo_path->extension();

        //     $request->profile_photo_path->move(public_path('uploads'), $fileName);

        //     $data['profile_photo_path'] = $fileName;
        // }

        $data['password'] = Hash::make('password');

        $user = User::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Data User Berhasil Di tambhakan!',
            'data' => $user
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json([
            'success' => true,
            'message' => 'List data User',
            'data' => $user
        ], 200
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, User $user)
    {
        //

        $data = $request->validated();
        // if($request->profile_photo_path != null){
        //     $fileName = time().'.'.$request->profile_photo_path->extension();

        //     $request->profile_photo_path->move(public_path('uploads'), $fileName);

        //     $data['profile_photo_path'] = $fileName;
        // }

        if($request->password != null){
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Data User Berhasil Di update!',
            'data' => $user
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data User Berhasil Di Hapus!',
            'data' => $user
        ], 200);
    }
}
