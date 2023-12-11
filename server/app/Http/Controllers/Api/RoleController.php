<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $roles = Role::latest()->get();
        return response()->json(['data' => $roles]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::get();
        return response()->json([
            'success' => true,
            'message' => 'List data Permission',
            'data' => $permission
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
            $request->validate([
                'name' => 'required',
                'permission' => 'required'
            ]);

            $role = Role::create(['name' => $request->name, 'guard_name'=> 'web']);
            $role->syncPermissions($request->permission);
            
            return  response()->json([
                'success' => true,
                'message' => 'Success Create Role',
                'data' => null
            ], 200);

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
        ->where("role_has_permissions.role_id",$id)
        ->get();

        $data['roles'] = $role;
        $data['permissions'] = $rolePermissions;

        return  response()->json([
            'success' => true,
            'message' => 'Show Data',
            'data' => $data
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $role = Role::find($id);

       $permission = Permission::get();

        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
        ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
        ->all();

        $data['role'] = $role;
        $data['permission'] = $permission;
        $data['rolePermission'] = $rolePermissions;

        return  response()->json([
            'success' => true,
            'message' => 'Success Get Data',
            'data' => $data
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'permission' => 'required'
        ]);

        $role = Role::find($id);
        $role->name = $request->name;
        $role->save();

        $role->syncPermissions($request->permission);

        return  response()->json([
            'success' => true,
            'message' => 'Success Update Data',
            'data' => $role
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        if($role){
            $role->delete();
            return  response()->json([
                'success' => true,
                'message' => 'Success Delete Data',
                'data' => $role
            ], 200);
        }
        return $this->sendError(null, 'Error Delete', 404);
    }
}
