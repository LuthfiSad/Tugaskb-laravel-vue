<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_kategori'
    ];
    public function acara(){
        return $this->hasMany(Acara::class);
    }
    public function artikel(){
        return $this->hasMany(Artikel::class);
    }
    public function sharing(){
        return $this->hasMany(Sharing::class);
    }
}
