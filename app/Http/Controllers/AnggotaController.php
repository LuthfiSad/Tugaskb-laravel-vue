<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // dd(Anggota::all());

        $anggotas = Anggota::get()->map(function ($anggota) {
            return [
                'id' => $anggota->id,
                'name' => $anggota->name,
                'nim' => $anggota->nim,
                'no_hp' => $anggota->no_hp,
                'email' => $anggota->email,
                'id_angkatan' => $anggota->id_angkatan,
                'angkatan' => $anggota->angkatan->angkatan,
            ];
        }); 
     
       // Return Json Response
       return response()->json([
          'anggotas' => $anggotas
       ], 200);
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            if($request['no_hp']){
                $request['no_hp'] = "0" . ltrim($request['no_hp'], '0');
            }
            $validated = $request->validate([
                'name' => 'required|max:255',
                'nim' => 'required|unique:anggotas|numeric|min_digits:10|max_digits:10',
                'no_hp'=> 'nullable|numeric|min_digits:10|max_digits:15',
                'email' => 'required|unique:anggotas|email:dns',
                'id_angkatan' => 'required|exists:angkatans,id',
            ]);
            $validated['name'] = Str::title($validated['name']);
            

            Anggota::create($validated);
            // dd($validated);
            return response()->json([
                'message' => "Data Anggota Berhasil Ditambah"
            ], 200);
        } catch (ValidationException $e) {
            // Jika validasi gagal, tangkap pengecualian dan kirimkan pesan JSON
            // return $errors;
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

    // public function show(Anggota $anggota)
    // {
    //     //
    //    return response()->json([
    //       'anggota' => $anggota
    //    ],200);
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Anggota $anggota)
    {
        //
        try {
            if($request['no_hp']){
                $request['no_hp'] = "0" . ltrim($request['no_hp'], '0');
            }
            $validated = $request->validate([
                'name' => 'required|max:255',
                'nim' => 'required|numeric|min_digits:10|max_digits:10|unique:anggotas,nim,' . $anggota->id,
                'no_hp'=> 'nullable|numeric|min_digits:10|max_digits:15',
                'email' => 'required|email:dns|unique:anggotas,email,' . $anggota->id,
                'id_angkatan' => 'required|exists:angkatans,id',
            ]);
            $validated['name'] = Str::title($validated['name']);

            $anggota->update($validated);
            // dd($validated);
            return response()->json([
                'message' => "Data Anggota Berhasil Diubah"
            ], 200);
        } catch (ValidationException $e) {
            // Jika validasi gagal, tangkap pengecualian dan kirimkan pesan JSON
            $formattedErrors = [];
            foreach ($e->validator->errors()->toArray() as $key => $value) {
                $formattedErrors[$key] = $value[0];
            }
            return response()->json([
                'message' => 'Gagal Mengubah Data',
                'errors' => $formattedErrors,
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Anggota $anggota)
    {
        //
        // dd($anggota);
        Anggota::destroy($anggota->id);
        return response()->json([
            'message' => "Data Anggota Berhasil Dihapus"
        ],200);
    }
}
