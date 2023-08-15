<?php

namespace App\Http\Controllers;

use App\Models\Sharing;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class SharingController extends Controller
{
    //
    public function index()
    {
        // dd(Sharing::all());
        $sharings = Sharing::get()->map(function ($sharing) {
            return [
                'id' => $sharing->id,
                'title' => $sharing->title,
                'deskripsi' => $sharing->deskripsi,
                'jadwal' => $sharing->jadwal,
                'image' => $sharing->image,
                'id_kategori' => $sharing->id_kategori,
                'name_kategori' => $sharing->kategori->name_kategori,
            ];
        }); 
     
       // Return Json Response
       return response()->json([
          'sharings' => $sharings
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
                'title' => 'required|max:255|unique:sharings',
                'deskripsi' => 'nullable|string',
                'jadwal'=> 'required|date_format:Y-m-d H:i:s|after:0 hours',
                'id_kategori' => 'required|exists:kategoris,id',
                'image' => 'image|file|max:3072',
            ]);

            if($request->file('image')){
                $validated['image'] = $request->file('image')->store('images');
            }
            $validated['title'] = Str::title($validated['title']);

            Sharing::create($validated);
            return response()->json([
                'message' => "Data Sharing Berhasil Ditambah"
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
    // public function show(Sharing $sharing)
    // {
    //     //
    //    return response()->json([
    //       'sharing' => $sharing
    //    ],200);
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sharing $sharing)
    {
        //

        try {
            $validated = $request->validate([
                'title' => 'required|max:255|unique:sharings,title,' . $sharing->id,
                'deskripsi' => 'nullable|string',
                'jadwal'=> 'required|date_format:Y-m-d H:i:s|after:0 hours',
                'id_kategori' => 'required|exists:kategoris,id',
                'image' => 'image|file|max:3072',
            ]);

            if($request->file('image')){
                // dd($acara->image);
                if($sharing->image){
                    Storage::delete($sharing->image);
                } 
                $validated['image'] = $request->file('image')->store('images');
            } elseif($request->default){
                // return response()->json([
                //     'message' => "default"
                // ], 200);
                if($sharing->image){
                    Storage::delete($sharing->image);
                } 
                $validated['image'] = null;
            }
            $validated['title'] = ucfirst($validated['title']);

            $sharing->update($validated);
            // dd($validated);
            return response()->json([
                'message' => "Data Sharing Berhasil Diubah"
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
    public function destroy(Sharing $sharing)
    {
        //
        if($sharing->image){
            // dd('ada gambar');
            Storage::delete($sharing->image);
        }
        Sharing::destroy($sharing->id);
        return response()->json([
            'message' => "Product successfully deleted."
        ],200);
    }
}
