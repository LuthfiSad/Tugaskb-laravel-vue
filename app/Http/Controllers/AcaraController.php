<?php

namespace App\Http\Controllers;

use App\Models\Acara;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class AcaraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(Acara::all());
        $acaras = Acara::get()->map(function ($acara) {
            return [
                'id' => $acara->id,
                'title' => $acara->title,
                'deskripsi' => $acara->deskripsi,
                'jadwal' => $acara->jadwal,
                'image' => $acara->image,
                'id_kategori' => $acara->id_kategori,
                'name_kategori' => $acara->kategori->name_kategori,
            ];
        }); 
     
       // Return Json Response
       return response()->json([
          'acaras' => $acaras
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
                'title' => 'required|max:255|unique:acaras|unique:acaras',
                'deskripsi' => 'nullable|string',
                'jadwal'=> 'required|date_format:Y-m-d H:i:s|after:0 hours',
                'id_kategori' => 'required|exists:kategoris,id',
                'image' => 'image|file|max:3072',
            ]);

            if($request->file('image')){
                $validated['image'] = $request->file('image')->store('images');
            }
            $validated['title'] = Str::title($validated['title']);

            Acara::create($validated);
            return response()->json([
                'message' => "Data Acara Berhasil Ditambah"
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

    /**
     * Display the specified resource.
     */
    // public function show(Acara $acara)
    // {
    //     //
    //     // dd($acara);
    //    return response()->json([
    //       'acara' => $acara
    //    ],200);
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Acara $acara)
    {
        //
        try {
            $validated = $request->validate([
                'title' => 'required|max:255|unique:acaras,title,' . $acara->id,
                'deskripsi' => 'nullable|string',
                'jadwal'=> 'required|date_format:Y-m-d H:i:s|after:0 hours',
                'id_kategori' => 'required|exists:kategoris,id',
                'image' => 'image|file|max:3072',
            ]);

            if($request->file('image')){
                // dd($acara->image);
                if($acara->image){
                    Storage::delete($acara->image);
                } 
                $validated['image'] = $request->file('image')->store('images');
            } elseif($request->default){
                // return response()->json([
                //     'message' => "default"
                // ], 200);
                if($acara->image){
                    Storage::delete($acara->image);
                } 
                $validated['image'] = null;
            }
            $validated['title'] = Str::title($validated['title']);
            // dd($validated);
            $acara->update($validated);
            // dd($validated);
            return response()->json([
                'message' => "Data Acara Berhasil Diubah"
            ], 200);
        } catch (ValidationException $e) {
            $formattedErrors = [];
            foreach ($e->validator->errors()->toArray() as $key => $value) {
                $formattedErrors[$key] = $value[0];
            }
            // Jika validasi gagal, tangkap pengecualian dan kirimkan pesan JSON
            return response()->json([
                'message' => 'Gagal Mengubah Data',
                'errors' => $formattedErrors,
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Acara $acara)
    {
        //
        // dd($anggota);
        if($acara->image){
            // dd('ada gambar');
            Storage::delete($acara->image);
        }
        Acara::destroy($acara->id);
        return response()->json([
            'message' => "Data Acara Berhasil Dihapus"
        ],200);
    }
}
