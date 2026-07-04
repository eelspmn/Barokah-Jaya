<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pakaian - Barokah Jaya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5 mb-5" style="max-width: 800px;">
    <div class="card shadow p-4 rounded-4 border-0">
        <h4 class="fw-bold mb-4 text-primary">Form Tambah Pakaian Baru</h4>
        
        @if ($errors->any())
            <div class="alert alert-danger py-2 small">
                <ul class="mb-0 ps-3">@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
            </div>
        @endif

        <form action="{{ route('pakaian.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label small fw-bold">Nama Pakaian</label>
                    <input type="text" name="nama_pakaian" class="form-control" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label small fw-bold">Upload Gambar (JPG/PNG)</label>
                    <input type="file" name="gambar" class="form-control" accept="image/jpeg, image/png, image/jpg" required>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label class="form-label small fw-bold">Jenis Pakaian</label>
                    <select name="jenis" class="form-select" required>
                        <option value="Kemeja">Kemeja</option>
                        <option value="Kaos">Kaos</option>
                        <option value="Jaket">Jaket</option>
                        <option value="Celana">Celana</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label small fw-bold">Ukuran Tersedia</label><br>
                    <div class="d-flex gap-3 mt-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="ukuran[]" value="S">
                            <label class="form-check-label">S</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="ukuran[]" value="M">
                            <label class="form-check-label">M</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="ukuran[]" value="L">
                            <label class="form-check-label">L</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="ukuran[]" value="XL">
                            <label class="form-check-label">XL</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label small fw-bold">Warna Tersedia</label>
                    <input type="text" name="warna" class="form-control" placeholder="Contoh: Hitam, Putih, Navy" required>
                    <small class="text-muted" style="font-size: 0.75rem;">Pisahkan dengan tanda koma (,)</small>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label small fw-bold">Harga (Rupiah)</label>
                    <input type="number" name="harga" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label small fw-bold">Stok Awal</label>
                    <input type="number" name="stok" class="form-control" required>
                </div>
                <div class="col-12 mb-4">
                    <label class="form-label small fw-bold">Deskripsi Produk</label>
                    <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
                </div>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success w-100 fw-bold">Simpan Produk</button>
                <a href="{{ route('pakaian.index') }}" class="btn btn-outline-secondary w-100 fw-bold">Batal</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>