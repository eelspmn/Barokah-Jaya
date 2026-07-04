<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Pakaian - Barokah Jaya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .product-card { border: none; border-radius: 12px; transition: 0.3s; }
        .product-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .product-img { border-top-left-radius: 12px; border-top-right-radius: 12px; height: 250px; object-fit: cover; }
        .badge-jenis { position: absolute; top: 10px; right: 10px; z-index: 2;}
        .navbar-brand { font-weight: bold; font-size: 1.5rem; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3">
    <div class="container">
        <a class="navbar-brand" href="#">🛒 Barokah Jaya</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('beranda.index') }}">Beranda</a>
                </li>
            </ul>
            <div class="d-flex align-items-center gap-3">
                <span class="text-white">Halo, {{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                </form>
            </div>
        </div>
    </div>
</nav>

<div class="bg-primary text-white py-5 mb-5 text-center">
    <div class="container">
        <h1 class="display-5 fw-bold">Koleksi Pakaian Terbaik</h1>
        <p class="lead">Temukan gaya terbaikmu dengan pakaian berkualitas dari Barokah Jaya.</p>
    </div>
</div>

<div class="container mb-5">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
        @forelse ($data_pakaian as $p)
            <div class="col">
                <div class="card product-card h-100 shadow-sm position-relative">
                    <span class="badge bg-warning text-dark badge-jenis">{{ $p->jenis }}</span>
                    
                    <img src="{{ $p->gambar ? asset('storage/' . $p->gambar) : 'https://via.placeholder.com/250?text=Tanpa+Gambar' }}" class="card-img-top product-img" alt="{{ $p->nama_pakaian }}">
                    
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold text-truncate">{{ $p->nama_pakaian }}</h5>
                        <p class="card-text text-muted small mb-2 text-truncate">{{ $p->deskripsi }}</p>
                        
                        <div class="mt-auto">
                            <h5 class="text-success fw-bold mb-3">Rp {{ number_format($p->harga, 0, ',', '.') }}</h5>
                            <a href="{{ route('beranda.show', $p->id) }}" class="btn btn-outline-primary w-100 rounded-pill">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted fs-5">Katalog masih kosong. Belum ada produk yang tersedia.</p>
            </div>
        @endforelse
    </div>
</div>

<footer class="bg-dark text-white text-center py-4 mt-auto">
    <div class="container">
        <p class="mb-0">&copy; {{ date('Y') }} Barokah Jaya. All rights reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>