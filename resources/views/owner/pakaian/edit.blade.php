<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pakaian - Barokah Jaya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5 mb-5" style="max-width: 800px;">
    <div class="card shadow p-4 rounded-4 border-0">
        <h4 class="fw-bold mb-4 text-warning">Form Edit Data Pakaian</h4>
        
        @if ($errors->any())
            <div class="alert alert-danger py-2 small">
                <ul class="mb-0 ps-3">@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
            </div>
        @endif

        <form action="{{ route('pakaian.update', $pakaian->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label small fw-bold">Nama Pakaian</label>
                    <input type="text" name="nama_pakaian" class="form-control" value="{{ $pakaian->nama_pakaian }}" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label small fw-bold">Upload Gambar Baru (Opsional)</label>
                    <input type="file" name="gambar" class="form-control" accept="image/jpeg, image/png, image/jpg">
                    <small class="text-muted" style="font-size: 0.75rem;">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                    
                    @if($pakaian->gambar)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $pakaian->gambar) }}" alt="Gambar Saat Ini" class="img-thumbnail" width="100">
                        </div>
                    @endif
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label small fw-bold">Jenis Pakaian</label>
                    <select name="jenis" class="form-select" required>
                        <option value="Kemeja" {{ $pakaian->jenis == 'Kemeja' ? 'selected' : '' }}>Kemeja</option>
                        <option value="Kaos" {{ $pakaian->jenis == 'Kaos' ? 'selected' : '' }}>Kaos</option>
                        <option value="Jaket" {{ $pakaian->jenis == 'Jaket' ? 'selected' : '' }}>Jaket</option>
                        <option value="Celana" {{ $pakaian->jenis == 'Celana' ? 'selected' : '' }}>Celana</option>
                    </select>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label class="form-label small fw-bold">Ukuran Tersedia</label><br>
                    @php $ukuran_tersedia = explode(', ', $pakaian->ukuran); @endphp
                    <div class="d-flex gap-3 mt-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="ukuran[]" value="S" {{ in_array('S', $ukuran_tersedia) ? 'checked' : '' }}>
                            <label class="form-check-label">S</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="ukuran[]" value="M" {{ in_array('M', $ukuran_tersedia) ? 'checked' : '' }}>
                            <label class="form-check-label">M</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="ukuran[]" value="L" {{ in_array('L', $ukuran_tersedia) ? 'checked' : '' }}>
                            <label class="form-check-label">L</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="ukuran[]" value="XL" {{ in_array('XL', $ukuran_tersedia) ? 'checked' : '' }}>
                            <label class="form-check-label">XL</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label small fw-bold">Warna Tersedia</label>
                    <input type="text" name="warna" class="form-control" value="{{ $pakaian->warna }}" placeholder="Contoh: Hitam, Putih, Navy" required>
                    <small class="text-muted" style="font-size: 0.75rem;">Pisahkan dengan tanda koma (,)</small>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label small fw-bold">Harga (Rupiah)</label>
                    <input type="number" name="harga" class="form-control" value="{{ $pakaian->harga }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label small fw-bold">Stok</label>
                    <input type="number" name="stok" class="form-control" value="{{ $pakaian->stok }}" required>
                </div>
                <div class="col-12 mb-4">
                    <label class="form-label small fw-bold">Deskripsi Produk</label>
                    <textarea name="deskripsi" class="form-control" rows="4" required>{{ $pakaian->deskripsi }}</textarea>
                </div>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning w-100 fw-bold">Perbarui Data</button>
                <a href="{{ route('pakaian.index') }}" class="btn btn-outline-secondary w-100 fw-bold">Batal</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>