<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    //
    public function authenticate(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email:dns',
                'password' => 'required',
            ]);
            
            $user= User::where('email', $request->email)->first();
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'message' => 'Akun tidak Tersedia Silahkan Registrasi Terlebih Dauhlu',
                    'errors' => [],
                ], 422);
            }
            $token = $user->createToken('kbapi')->plainTextToken;
            return response()->json([
                'message' => 'Selamat Datang '. $user->name,
                'token' => $token
            ], 200);;
            
        } catch (ValidationException $e) {
            $formattedErrors = [];
            foreach ($e->validator->errors()->toArray() as $key => $value) {
                $formattedErrors[$key] = $value[0];
            }
            return response()->json([
                'message' => 'Gagal Login',
                'errors' => $formattedErrors,
            ], 422);
        }
        // dd('berhasil masuk');
        // return $request;
    }

    public function logout(Request $request){
        // dd($request->user()->tokens());
        $request->user()->tokens()->delete();
        return response()->json([
            'message' => 'Anda Berhasil Logout',
        ], 200);
    }

    public function store(Request $request){
        try {
            if($request['no_hp']){
                $request['no_hp'] = "0" . ltrim($request['no_hp'], '0');
            }
            $validated = $request->validate([
                'name' => 'required|max:255',
                'no_hp' => 'unique:users|numeric|min_digits:10|max_digits:13',
                'email' => 'required|email:dns|unique:users',
                'password' => 'required|min:8|confirmed',
                'password_confirmation'=> 'required'
            ]);
            $validated['name'] = ucfirst($validated['name']);
            $validated['password'] = bcrypt($validated['password']);
            User::create($validated);
            return response()->json([
                'message' => "Berhasil Registrasi"
            ], 200);
        } catch (ValidationException $e) {
            $formattedErrors = [];
            foreach ($e->validator->errors()->toArray() as $key => $value) {
                $formattedErrors[$key] = $value[0];
            }
            return response()->json([
                'message' => 'Gagal Menambah Data',
                'errors' => $formattedErrors,
            ], 422);
        }
    }
}