<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sharing extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'deskripsi',
        'jadwal',
        'id_kategori',
        'image',
    ];
    protected $with = ['kategori'];

    // public function getRouteKeyName(){
    //     return 'nim';
    // }

    public function kategori(){
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }
}
