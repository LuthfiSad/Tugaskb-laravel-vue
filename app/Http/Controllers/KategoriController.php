<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class KategoriController extends Controller
{
    //
    public function index()
    {
        //
        $kategoris = Kategori::all();
     
       // Return Json Response
       return response()->json([
          'kategoris' => $kategoris
       ], 200);
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            $validated = $request->validate([
                'name_kategori' => 'required|unique:kategoris|max:15'
            ]);
            $validated['name_kategori'] = Str::title($validated['name_kategori']);
            // dd($validated);
            Kategori::create($validated);
            return response()->json([
                'message' => "Data Kategori Berhasil Ditambah"
            ], 200);
        } catch (ValidationException $e) {
            $formattedErrors = [];
            foreach ($e->validator->errors()->toArray() as $key => $value) {
                $formattedErrors[$key] = $value[0];
            }
            // Jika validasi gagal, tangkap pengecualian dan kirimkan pesan JSON
            return response()->json([
                'message' => 'Gagal Manambah Data',
                'errors' => $formattedErrors,
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        //
        Kategori::destroy($kategori->id);
        return response()->json([
            'message' => "Data Kategori Berhasil Dihapus"
        ],200);
    }
}
