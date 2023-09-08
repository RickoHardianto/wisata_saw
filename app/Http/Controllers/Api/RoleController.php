<?php

namespace App\Http\Controllers\Api;
use App\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ApiResource;
use Illuminate\Support\Facades\Validator;


class RoleController extends Controller
{
    public function index(){
        $role = Role::latest()->paginate(5);

        return new ApiResource(true, 'List Data Role', $role);
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'namaRole'     => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $role = role::create([
            'namaRole' => $request->namaRole
        ]);

        // return response 
        return new ApiResource(true, 'Data Role Berhasil Di tambhakan!', $role);
    }

    public function update(Request $request, role $role){

        $validator = Validator::make($request->all(), [
            'namaRole'     => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $role->update([
            'namaRole' => $request->namaRole
        ]);

        return new ApiResource(true, 'Data role Berhasil Di Update!', $role);
    }

    public function destroy(role $role){
        $role->delete();

        return new ApiResource(true, 'Data role Berhasil Di Hapus!', $role);
    }
}
