<?php

namespace App\Http\Controllers;

use App\Models\Angkatan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AngkatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $angkatans = Angkatan::orderBy('angkatan', 'DESC')->get()->makeHidden(['created_at', 'updated_at']);
       // Return Json Response
       return response()->json([
          'angkatans' => $angkatans
       ], 200);
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            $year = date("Y");
            $validated = $request->validate([
                'angkatan' => 'required|min_digits:4|min:'. ($year-15) .'|max:'.$year.'|max_digits:4|unique:angkatans|numeric'
            ]);
            $validated['angkatan'] = Str::title($validated['angkatan']);
            // dd($validated);
            Angkatan::create($validated);
            return response()->json([
                'message' => "Data Acara Berhasil Ditambah"
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
    public function destroy(Angkatan $angkatan)
    {
        //
        // $angkatans = Angkatan::find($angkatan->id);
        // if(!$angkatans){
        //   return response()->json([
        //      'message'=>'Product Not Found.'
        //   ],404);
        // }
        Angkatan::destroy($angkatan->id);
        return response()->json([
            'message' => "Data Angkatan Berhasil Dihapus"
        ],200);
    }
}
