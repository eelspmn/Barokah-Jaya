<?php

namespace App\Http\Controllers;

use App\Models\Pakaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BerandaController extends Controller
{
    public function index()
    {
        $data_pakaian = Pakaian::all();
        return view('beranda.index', compact('data_pakaian'));
    }

    public function show($id)
    {
        $pakaian = Pakaian::findOrFail($id);
        return view('beranda.show', compact('pakaian'));
    }

    // Method Baru untuk Halaman Checkout
    public function checkout($id, Request $request)
    {
        $pakaian = Pakaian::findOrFail($id);
        
        // Menangkap data warna, ukuran, dan jumlah dari form sebelumnya
        $warna_pilihan = $request->query('warna', 'Default');
        $ukuran_pilihan = $request->query('ukuran', 'Default');
        $jumlah = $request->query('jumlah', 1);
        
        // Kalkulasi Harga
        $total_harga = $pakaian->harga * $jumlah;
        $ongkir = 15000; // Ongkir flat Rp 15.000
        $total_bayar = $total_harga + $ongkir;

        return view('beranda.checkout', compact(
            'pakaian', 'warna_pilihan', 'ukuran_pilihan', 'jumlah', 'total_harga', 'ongkir', 'total_bayar'
        ));
    }
}