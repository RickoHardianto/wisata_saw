<?php

namespace App\Http\Controllers\Api;
use App\Models\Profile;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ApiResource;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index(){
        $profile = Profile::latest()->paginate(5);

        return new ApiResource(true, 'List Data userProfile', $profile);
    }

    public function store(Request $request){
 
        $validator = Validator::make($request->all(), [
            'tanggalLahir'     => 'required',
            'alamat'           => 'required',
            'profilePicture'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $profile = Profile::create([
            'tanggalLahir'     => $request->tanggalLahir,
            'alamat'           => $request->alamat,
            'profilePicture'   => $request->profilePicture,
        ]);

        // return response 
        return new ApiResource(true, 'Data Profile Berhasil Di tambhakan!', $profile);
    }

    public function update(Request $request, profile $profile){

        $validator = Validator::make($request->all(), [
            'tanggalLahir'     => 'required',
            'alamat'           => 'required',
            'profilePicture'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $profile->update([
            'tanggalLahir'     => $request->tanggalLahir,
            'alamat'           => $request->alamat,
            'profilePicture'   => $request->profilePicture,
        ]);

        return new ApiResource(true, 'Data profile Berhasil Di Update!', $profile);
    }

    public function destroy(profile $profile){
        $profile->delete();

        return new ApiResource(true, 'Data profile Berhasil Di Hapus!', $profile);
    }
}
