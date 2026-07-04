<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Barokah Jaya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .gradient-card-1 { background: linear-gradient(135deg, #4e73df, #224abe); color: white; }
        .gradient-card-2 { background: linear-gradient(135deg, #1cc88a, #0f8f60); color: white; }
        .gradient-card-3 { background: linear-gradient(135deg, #f6c23e, #d89e1b); color: white; }
        .stat-card { border-radius: 15px; border: none; transition: transform 0.2s; }
        .stat-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .header-panel { background: #212529; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark header-panel shadow-sm py-3 mb-4">
    <div class="container">
        <a class="navbar-brand fw-bolder fs-4 text-warning" href="#">👑 Panel Admin Barokah Jaya</a>
        <div class="d-flex align-items-center gap-3">
            <span class="text-white small">Halo Bos, <strong>{{ Auth::user()->name }}</strong></span>
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3 fw-bold">Keluar</button>
            </form>
        </div>
    </div>
</nav>

<div class="container pb-5">
    
    <div class="p-5 mb-4 bg-white rounded-4 shadow-sm border-0 d-flex justify-content-between align-items-center">
        <div>
            <h1 class="display-6 fw-bold text-dark mb-2">Selamat Datang Kembali! 🚀</h1>
            <p class="fs-6 text-muted mb-0">Pantau performa toko, kelola inventaris barang, dan cek ketersediaan stok Barokah Jaya dengan mudah dari satu tempat.</p>
        </div>
        <div class="d-none d-md-block">
            <img src="https://cdn-icons-png.flaticon.com/512/3201/3201521.png" width="100" alt="Dashboard Icon" class="opacity-75">
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card stat-card gradient-card-1 h-100 shadow-sm p-3">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h6 class="text-uppercase fw-bold opacity-75 mb-1">Total Jenis Pakaian</h6>
                        <h2 class="fw-bolder display-5 mb-0">{{ $total_produk }}</h2>
                    </div>
                    <div class="mt-3">
                        <span class="small opacity-75">Macam produk di etalase</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card stat-card gradient-card-2 h-100 shadow-sm p-3">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h6 class="text-uppercase fw-bold opacity-75 mb-1">Total Stok Baju Fisik</h6>
                        <h2 class="fw-bolder display-5 mb-0">{{ $total_stok }}</h2>
                    </div>
                    <div class="mt-3">
                        <span class="small opacity-75">Pcs tersedia di gudang</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card stat-card gradient-card-3 h-100 shadow-sm p-3">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h6 class="text-uppercase fw-bold opacity-75 mb-1">Peringatan Stok Menipis</h6>
                        <h2 class="fw-bolder display-5 mb-0">{{ $stok_menipis }}</h2>
                    </div>
                    <div class="mt-3">
                        <span class="small opacity-75">Produk dengan stok <= 5 pcs</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-12">
            <h4 class="fw-bold text-dark mb-3">Aksi Cepat</h4>
        </div>
        
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 text-center p-4">
                <div class="mb-3"><span class="fs-1">📦</span></div>
                <h5 class="fw-bold">Manajemen Produk</h5>
                <p class="text-muted small">Kelola harga, stok, edit dan hapus barang yang dijual.</p>
                <a href="{{ route('pakaian.index') }}" class="btn btn-dark w-100 rounded-pill fw-bold mt-auto">Buka Manajemen</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 text-center p-4">
                <div class="mb-3"><span class="fs-1">➕</span></div>
                <h5 class="fw-bold">Tambah Barang Baru</h5>
                <p class="text-muted small">Masukkan koleksi pakaian baru ke dalam katalog toko.</p>
                <a href="{{ route('pakaian.create') }}" class="btn btn-primary w-100 rounded-pill fw-bold mt-auto">Tambah Produk</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 text-center p-4">
                <div class="mb-3"><span class="fs-1">🛍️</span></div>
                <h5 class="fw-bold">Lihat Toko</h5>
                <p class="text-muted small">Lihat tampilan beranda katalog yang dilihat pelanggan.</p>
                <a href="{{ route('beranda.index') }}" class="btn btn-outline-dark w-100 rounded-pill fw-bold mt-auto">Cek Beranda</a>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>