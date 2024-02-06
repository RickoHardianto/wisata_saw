<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Dotenv\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'password'  => 'required|string|min:8'
        ]);

        $numberPhone = $request->input('numberPhone');

        if ($numberPhone && is_string($numberPhone) && $numberPhone[0] == "8") {
            $numberPhone = "62" . $numberPhone;
        }


        $user = User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'numberPhone'  => $numberPhone,
            'password'      => Hash::make($request->password),
            'address'      => $request->address,
        ]);

        $token = $user->createToken('ApiToken')->plainTextToken;

        $response = [
            'success' => true,
            'user' => $user,
            'token' => $token,
            'message' => 'Berhasil Register'
        ];

        return response($response, 201);
    }

    // method for login
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response([
                    'success' => false,
                    'message' => ['These credentials do not match our records.']
                ], 404);
            }

            $token = $user->createToken('ApiToken')->plainTextToken;

            $response = [
                'success' => true,
                'user' => $user,
                'token' => $token,
                'message' => 'Berhasil Login'
            ];

            return response($response, 201);
        } catch (\Exception $e) {
            // Tangani pengecualian di sini
            return response([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    // public function profile()
    // {
    //     return response()->json(['message' => 'Your Profile', 'data' => Auth::user()]);
    // }

    // method for profile update
    // public function update(Request $request)
    // {
    //     $user = Auth::user();

    //     $request->validate([
    //         'name'      => 'required|string|max:255',
    //         'email'     => 'required|string|email|max:255|unique:users,email,' . $user->id,
    //         'password'  => 'nullable|string|min:8'
    //     ]);

    //     $numberPhone = $request['numberPhone'];
    //     if ($request['numberPhone'][0] == "0") {
    //         $numberPhone = substr($numberPhone, 1);
    //     }

    //     if ($numberPhone[0] == "8") {
    //         $numberPhone = "62" . $numberPhone;
    //     }

    //     $user->update([
    //         'name'          => $request->name,
    //         'email'         => $request->email,
    //         'numberPhone'  => $numberPhone,
    //         'password'      => $request->password ? Hash::make($request->password) : $user->password
    //     ]);

    //     return response()->json(['message' => 'Data Updated Successfully', 'data' => $user]);
    // }

    // method for user logout and delete token
    public function logout()
    {
        auth()->logout();
        return response()->json([
            'success'    => true,
            'message'    => 'Berhasil Logout'
        ], 200);
    }
}
