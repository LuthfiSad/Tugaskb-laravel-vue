<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ArtikelController extends Controller
{
    //
    public function index()
    {
        // dd(Artikel::all());
        $artikels = Artikel::get()->map(function ($artikel) {
            return [
                'id' => $artikel->id,
                'title' => $artikel->title,
                'deskripsi' => $artikel->deskripsi,
                'image' => $artikel->image,
                'id_kategori' => $artikel->id_kategori,
                'name_kategori' => $artikel->kategori->name_kategori,
            ];
        });

        return response()->json([
            'artikels' => $artikels
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
                'title' => 'required|max:255|unique:artikels',
                'deskripsi' => 'nullable|string',
                'id_kategori' => 'required|exists:kategoris,id',
                'image' => 'image|file|max:3072',
            ]);

            if ($request->file('image')) {
                $validated['image'] = $request->file('image')->store('images');
            }
            $validated['title'] = Str::title($validated['title']);

            Artikel::create($validated);
            return response()->json([
                'message' => "Data Artikel Berhasil Ditambah"
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
    // public function show(Artikel $artikel)
    // {
    //     //
    //    return response()->json([
    //       'artikel' => $artikel
    //    ],200);
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artikel $artikel)
    {
        //

        try {
            $validated = $request->validate([
                'title' => 'required|max:255|unique:artikels,title,' . $artikel->id,
                'deskripsi' => 'nullable|string',
                'id_kategori' => 'required|exists:kategoris,id',
                'image' => 'image|file|max:3072',
            ]);

            if ($request->file('image')) {
                // dd($acara->image);
                if ($artikel->image) {
                    Storage::delete($artikel->image);
                }
                $validated['image'] = $request->file('image')->store('images');
            } elseif ($request->default) {
                // return response()->json([
                //     'message' => "default"
                // ], 200);
                if ($artikel->image) {
                    Storage::delete($artikel->image);
                }
                $validated['image'] = null;
            }
            $validated['title'] = Str::title($validated['title']);

            $artikel->update($validated);
            // dd($validated);
            return response()->json([
                'message' => "Data Artikel Berhasil Diubah"
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
    public function destroy(Artikel $artikel)
    {
        //
        if ($artikel->image) {
            // dd('ada gambar');
            Storage::delete($artikel->image);
        }
        Artikel::destroy($artikel->id);
        return response()->json([
            'message' => "Data Artikel Berhasil Dihapus"
        ], 200);
    }
}
