<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Pakaian - Barokah Jaya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">Barokah Jaya Store</a>
        <div class="d-flex align-items-center">
            <span class="text-white me-3 small">Pelanggan: <strong>{{ Auth::user()->name }}</strong></span>
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-sm btn-light text-primary fw-bold">Keluar</button>
            </form>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h2 class="fw-bold text-dark mb-2">Katalog Pakaian Terbaru</h2>
    <p class="text-muted mb-4">Silakan pilih pakaian terbaik yang Anda inginkan. Stok selalu ter-update!</p>

    <div class="row">
        @forelse($data_pakaian as $p)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <span class="badge bg-secondary mb-2">{{ $p->jenis }}</span>
                    <h5 class="card-title fw-bold text-dark m-0">{{ $p->nama_pakaian }}</h5>
                    <p class="text-muted small mb-3">Ukuran: <strong class="text-primary">{{ $p->ukuran }}</strong></p>
                    
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <span class="fs-5 fw-bold text-success">Rp {{ number_format($p->harga, 0, ',', '.') }}</span>
                        <span class="text-muted small">Sisa Stok: <strong>{{ $p->stok }}</strong></span>
                    </div>
                </div>
                <div class="card-footer bg-white border-top-0 pb-3">
                    <button class="btn btn-primary btn-sm w-100" onclick="alert('Fitur Pembelian Belum Tersedia!')">Beli Sekarang</button>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <p class="text-muted fs-5">Maaf, saat ini toko kami sedang kehabisan stok pakaian.</p>
        </div>
        @endforelse
    </div>
</div>

</body>
</html>