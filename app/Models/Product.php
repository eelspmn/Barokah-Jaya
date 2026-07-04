<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Menentukan nama tabel (opsional, tapi aman)
    protected $table = 'products';

    // Daftarkan kolom yang boleh diisi melalui form CRUD (Sesuai konsep Modul 9)
    protected $fillable = [
        'nama_produk',
        'kategori',
        'deskripsi',
        'harga',
        'stok',
        'gambar'
    ];
}