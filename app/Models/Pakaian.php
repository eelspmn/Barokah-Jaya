<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pakaian extends Model
{
    use HasFactory;

    protected $table = 'pakaian';

    protected $fillable = [
        'nama_pakaian',
        'jenis',
        'ukuran',
        'warna',
        'harga',
        'stok',
        'deskripsi',
        'gambar'
    ];
}