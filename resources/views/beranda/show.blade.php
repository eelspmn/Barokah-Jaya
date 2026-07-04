<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Butiran Produk - Barokah Jaya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .img-detail { border-radius: 20px; object-fit: cover; width: 100%; height: 500px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
    </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark shadow-sm py-3 mb-5">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('beranda.index') }}">← Kembali ke Beranda</a>
    </div>
</nav>

<div class="container pb-5">
    <div class="row align-items-center bg-white p-4 p-md-5 rounded-4 shadow-sm">
        
        <div class="col-md-6 mb-4 mb-md-0">
            <img src="{{ $pakaian->gambar ? asset('storage/' . $pakaian->gambar) : 'https://via.placeholder.com/600x600?text=Tiada+Gambar' }}" alt="{{ $pakaian->nama_pakaian }}" class="img-detail">
        </div>

        <div class="col-md-6 ps-md-5">
            <span class="badge bg-primary mb-2 px-3 py-2 rounded-pill">{{ $pakaian->jenis }}</span>
            <h1 class="fw-bolder display-6 text-dark mb-2">{{ $pakaian->nama_pakaian }}</h1>
            <h2 class="fw-bold text-success mb-4">RM {{ number_format($pakaian->harga, 2, '.', ',') }}</h2>
            
            <p class="text-muted fs-6 lh-lg mb-4">{{ $pakaian->deskripsi }}</p>

            <form action="{{ route('beranda.checkout', $pakaian->id) }}" method="GET">
                
                <div class="row mb-4">
                    <div class="col-6">
                        <label class="fw-bold text-dark mb-2">Pilih Warna</label>
                        <select name="warna" class="form-select fw-bold border-dark" required>
                            <option value="" disabled selected>-- Warna --</option>
                            @php $warna_array = explode(',', $pakaian->warna); @endphp
                            @foreach($warna_array as $w)
                                <option value="{{ trim($w) }}">{{ trim($w) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="fw-bold text-dark mb-2">Pilih Size</label>
                        <select name="ukuran" class="form-select fw-bold border-dark" required>
                            <option value="" disabled selected>-- Size --</option>
                            @php $ukuran_array = explode(',', $pakaian->ukuran); @endphp
                            @foreach($ukuran_array as $u)
                                <option value="{{ trim($u) }}">{{ trim($u) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex align-items-center mb-4 gap-3">
                    <label class="fw-bold fs-5">Jumlah:</label>
                    <input type="number" name="jumlah" class="form-control text-center fw-bold w-25" value="1" min="1" max="{{ $pakaian->stok }}" required>
                    <span class="text-muted small">Tinggal {{ $pakaian->stok }} unit</span>
                </div>
                
                <button type="submit" class="btn btn-dark btn-lg w-100 rounded-pill fw-bold py-3 shadow-sm">
                    🛒 Teruskan ke Pembayaran Selamat
                </button>
            </form>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>