<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pakaian - Barokah Jaya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6f9; }
        .product-card {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 25px rgba(0,0,0,0.1) !important;
        }
        .product-img {
            height: 240px;
            object-fit: cover;
            width: 100%;
        }
        .badge-kategori {
            position: absolute;
            top: 15px;
            left: 15px;
            z-index: 2;
            font-weight: bold;
        }
        .badge-stok {
            position: absolute;
            top: 15px;
            right: 15px;
            z-index: 2;
            font-weight: bold;
        }
        .header-panel {
            background: linear-gradient(135deg, #212529, #343a40);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark header-panel shadow-sm py-3 mb-4">
    <div class="container">
        <a class="navbar-brand fw-bolder fs-4 text-warning" href="#">👑 Panel Admin Barokah Jaya</a>
        <div class="d-flex gap-3 align-items-center">
            <a href="{{ route('beranda.index') }}" class="btn btn-outline-light btn-sm rounded-pill px-3 fw-bold">Lihat Beranda Toko</a>
            <a href="{{ route('owner.dashboard') }}" class="btn btn-secondary btn-sm rounded-pill px-3 fw-bold">Kembali ke Dashboard</a>
        </div>
    </div>
</nav>

<div class="container mb-5">
    
    <div class="d-flex justify-content-between align-items-center mb-4 bg-white p-4 rounded-4 shadow-sm border-0">
        <div>
            <h2 class="fw-bolder text-dark mb-0">Manajemen Katalog Produk</h2>
            <p class="text-muted mb-0 small mt-1">Atur semua produk yang akan tampil di halaman pelanggan Anda di sini.</p>
        </div>
        <div>
            <a href="{{ route('pakaian.create') }}" class="btn btn-primary btn-lg rounded-pill fw-bold shadow-sm px-4">
                + Tambah Produk Baru
            </a>
        </div>
    </div>

    @if(session('sukses'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm border-0 bg-success text-white px-4 py-3" role="alert">
            <strong class="fs-5">🎉 Berhasil!</strong> <span class="ms-2">{{ session('sukses') }}</span>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        @forelse($data_pakaian as $p)
        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="card product-card bg-white h-100 shadow-sm position-relative">
                
                <span class="badge bg-primary badge-kategori rounded-pill px-3 py-2 shadow-sm">{{ $p->jenis }}</span>
                
                @if($p->stok < 5)
                    <span class="badge bg-danger badge-stok rounded-pill px-3 py-2 shadow-sm">Sisa Stok: {{ $p->stok }}</span>
                @else
                    <span class="badge bg-success badge-stok rounded-pill px-3 py-2 shadow-sm">Stok: {{ $p->stok }}</span>
                @endif

                <img src="{{ $p->gambar ? asset('storage/' . $p->gambar) : 'https://via.placeholder.com/400x400?text=Tanpa+Gambar' }}" class="product-img" alt="Gambar Produk">
                
                <div class="card-body d-flex flex-column p-4">
                    <h5 class="fw-bold text-dark mb-1 text-truncate" title="{{ $p->nama_pakaian }}">{{ $p->nama_pakaian }}</h5>
                    
                    <div class="d-flex flex-column gap-1 mb-2 mt-2">
                        <div><span class="badge border border-dark text-dark px-2 py-1">Size: {{ $p->ukuran }}</span></div>
                        <div class="text-muted small fw-bold text-truncate" title="{{ $p->warna }}">Warna: {{ $p->warna }}</div>
                    </div>
                    
                    <p class="text-muted small mb-4 mt-2 text-truncate">{{ $p->deskripsi }}</p>
                    
                    <div class="mt-auto border-top pt-3">
                        <h4 class="fw-bolder text-success mb-3 text-center">Rp {{ number_format($p->harga, 0, ',', '.') }}</h4>
                        
                        <div class="d-flex gap-2">
                            <a href="{{ route('pakaian.edit', $p->id) }}" class="btn btn-warning w-50 rounded-pill fw-bold text-dark py-2 shadow-sm transition">
                                ✏️ Edit
                            </a>
                            <form action="{{ route('pakaian.destroy', $p->id) }}" method="POST" class="w-50" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini dari toko secara permanen?')">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger w-100 rounded-pill fw-bold py-2 shadow-sm transition">
                                    🗑️ Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        @empty
        <div class="col-12">
            <div class="text-center py-5 bg-white rounded-4 shadow-sm border-0">
                <img src="https://cdn-icons-png.flaticon.com/512/4076/4076432.png" width="150" class="mb-4 opacity-50" alt="Ikon Kosong">
                <h3 class="text-dark fw-bold">Belum ada produk di toko Anda.</h3>
                <p class="text-muted fs-5">Mulai jualan dengan menambahkan produk pertama Anda.</p>
                <a href="{{ route('pakaian.create') }}" class="btn btn-primary btn-lg rounded-pill fw-bold mt-3 px-5">+ Tambah Produk</a>
            </div>
        </div>
        @endforelse
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>