<?php

namespace App\Http\Controllers;

use App\Models\Pakaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PakaianController extends Controller
{
    public function index()
    {
        $data_pakaian = Pakaian::all();
        return view('owner.pakaian.index', compact('data_pakaian'));
    }

    public function create()
    {
        return view('owner.pakaian.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pakaian' => 'required|string|max:255',
            'jenis'        => 'required',
            'ukuran'       => 'required|array',
            'warna'        => 'required|string',
            'harga'        => 'required|numeric|min:0',
            'stok'         => 'required|numeric|min:0',
            'deskripsi'    => 'required|string',
            'gambar'       => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validasi file gambar
        ]);

        $data = $request->all();
        $data['ukuran'] = implode(', ', $request->ukuran); 

        // Upload Gambar
        if ($request->hasFile('gambar')) {
            // Menyimpan gambar ke dalam folder storage/app/public/pakaian
            $gambarPath = $request->file('gambar')->store('pakaian', 'public');
            $data['gambar'] = $gambarPath;
        }

        Pakaian::create($data);
        return redirect()->route('pakaian.index')->with('sukses', 'Data pakaian berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $pakaian = Pakaian::findOrFail($id);
        return view('owner.pakaian.edit', compact('pakaian'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pakaian' => 'required|string|max:255',
            'jenis'        => 'required',
            'ukuran'       => 'required|array',
            'warna'        => 'required|string',
            'harga'        => 'required|numeric|min:0',
            'stok'         => 'required|numeric|min:0',
            'deskripsi'    => 'required|string',
            'gambar'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Gambar opsional saat edit
        ]);

        $pakaian = Pakaian::findOrFail($id);
        
        $data = $request->all();
        $data['ukuran'] = implode(', ', $request->ukuran); 

        // Update Gambar jika ada yang baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($pakaian->gambar && Storage::disk('public')->exists($pakaian->gambar)) {
                Storage::disk('public')->delete($pakaian->gambar);
            }
            // Simpan gambar baru
            $gambarPath = $request->file('gambar')->store('pakaian', 'public');
            $data['gambar'] = $gambarPath;
        } else {
            // Jika tidak ada gambar baru, gunakan gambar yang lama
            $data['gambar'] = $pakaian->gambar;
        }

        $pakaian->update($data);
        return redirect()->route('pakaian.index')->with('sukses', 'Data pakaian berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pakaian = Pakaian::findOrFail($id);
        
        // Hapus file gambar dari storage saat data dihapus
        if ($pakaian->gambar && Storage::disk('public')->exists($pakaian->gambar)) {
            Storage::disk('public')->delete($pakaian->gambar);
        }
        
        $pakaian->delete();
        return redirect()->route('pakaian.index')->with('sukses', 'Data pakaian berhasil dihapus!');
    }
}