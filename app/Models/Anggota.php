<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nim',
        'no_hp',
        'email',
        'id_angkatan'
    ];
    protected $with = ['angkatan'];

    // public function getRouteKeyName(){
    //     return 'nim';
    // }

    public function angkatan(){
        return $this->belongsTo(Angkatan::class, 'id_angkatan');
    }
}
