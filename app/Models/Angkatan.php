<?php

namespace App\Models;

use App\Http\Controllers\AnggotaController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Angkatan extends Model
{
    use HasFactory;
    protected $fillable = [
        'angkatan'
    ];
    public function anggota(){
        return $this->hasMany(Anggota::class);
    }
}
