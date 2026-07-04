<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Checkout - Barokah Jaya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .checkout-container { max-width: 1000px; margin: 0 auto; }
        .payment-card { border-radius: 16px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .form-control, .form-select { border-radius: 8px; padding: 12px 15px; border-color: #dee2e6; }
        .form-control:focus, .form-select:focus { box-shadow: none; border-color: #212529; }
        .order-summary { background-color: #f1f3f5; border-radius: 16px; padding: 30px; }
        .product-mini-img { width: 80px; height: 80px; object-fit: cover; border-radius: 10px; }
        .payment-method-box { border: 2px solid #dee2e6; border-radius: 10px; padding: 15px; cursor: pointer; transition: all 0.2s; }
        .payment-method-box:hover { border-color: #212529; background-color: #f8f9fa; }
        .payment-method-radio:checked + label .payment-method-box { border-color: #198754; background-color: #f1fdf7; }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark py-3 mb-5">
    <div class="container checkout-container">
        <a class="navbar-brand fw-bold" href="{{ route('beranda.show', $pakaian->id) }}">
            <span class="text-white-50">← Batal</span> &nbsp; Barokah Jaya Secure Checkout
        </a>
        <span class="badge bg-success px-3 py-2 rounded-pill"><i class="bi bi-lock-fill"></i> Pembayaran Aman</span>
    </div>
</nav>

<div class="container checkout-container pb-5">
    
    <form id="checkoutForm">
        <div class="row g-5">
            
            <div class="col-lg-7">
                <div class="card payment-card p-4 p-md-5 mb-4">
                    <h4 class="fw-bold mb-4">Informasi Pengiriman</h4>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-12">
                            <label class="form-label fw-semibold small">Nama Lengkap</label>
                            <input type="text" id="nama" class="form-control" value="{{ Auth::user()->name }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Email</label>
                            <input type="email" id="email" class="form-control" value="{{ Auth::user()->email }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Nomor WhatsApp / HP</label>
                            <input type="tel" id="nohp" class="form-control" placeholder="081234567890" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold small">Alamat Lengkap Pengiriman</label>
                            <textarea id="alamat" class="form-control" rows="3" placeholder="Nama Jalan, RT/RW, Kelurahan, Kecamatan, Kota, Kode Pos" required></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold small">Catatan untuk Kurir (Opsional)</label>
                            <input type="text" id="catatan" class="form-control" placeholder="Titip di pos satpam, atau warna cat pagar">
                        </div>
                    </div>

                    <h4 class="fw-bold mb-4 mt-5">Metode Pembayaran</h4>
                    
                    <div class="d-flex flex-column gap-3">
                        <div class="form-check p-0">
                            <input class="form-check-input d-none payment-method-radio" type="radio" name="payment_method" id="pay_transfer" value="Transfer Bank" required>
                            <label class="form-check-label w-100" for="pay_transfer">
                                <div class="payment-method-box d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="fw-bold mb-1">Transfer Bank (Manual)</h6>
                                        <small class="text-muted">BCA / Mandiri / BRI / BNI</small>
                                    </div>
                                    <span class="fs-4">🏦</span>
                                </div>
                            </label>
                        </div>

                        <div class="form-check p-0">
                            <input class="form-check-input d-none payment-method-radio" type="radio" name="payment_method" id="pay_ewallet" value="E-Wallet (OVO/Dana/GoPay)" required>
                            <label class="form-check-label w-100" for="pay_ewallet">
                                <div class="payment-method-box d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="fw-bold mb-1">E-Wallet (OVO/Dana/GoPay)</h6>
                                        <small class="text-muted">Transfer ke nomor HP Admin</small>
                                    </div>
                                    <span class="fs-4">📱</span>
                                </div>
                            </label>
                        </div>

                        <div class="form-check p-0">
                            <input class="form-check-input d-none payment-method-radio" type="radio" name="payment_method" id="pay_cod" value="Cash on Delivery (COD)" required>
                            <label class="form-check-label w-100" for="pay_cod">
                                <div class="payment-method-box d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="fw-bold mb-1">Cash on Delivery (COD)</h6>
                                        <small class="text-muted">Bayar tunai ke kurir saat barang sampai</small>
                                    </div>
                                    <span class="fs-4">📦</span>
                                </div>
                            </label>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-5">
                <div class="order-summary sticky-top" style="top: 20px;">
                    <h4 class="fw-bold mb-4">Ringkasan Pesanan</h4>
                    
                    <div class="d-flex gap-3 mb-4 border-bottom pb-4">
                        
                        <img src="{{ $pakaian->gambar ? asset('storage/' . $pakaian->gambar) : 'https://via.placeholder.com/150?text=No+Image' }}" class="product-mini-img shadow-sm" alt="Produk">
                        
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="fw-bold text-dark mb-1" id="nama_produk">{{ $pakaian->nama_pakaian }}</h6>
                            <small class="text-muted mb-2">Varian: <span id="varian">{{ $warna_pilihan }}</span> | Ukuran: <span id="ukuran">{{ $ukuran_pilihan }}</span></small>
                            <span class="fw-semibold">Rp {{ number_format($pakaian->harga, 0, ',', '.') }} <span class="text-muted fw-normal">x <span id="jumlah">{{ $jumlah }}</span></span></span>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Subtotal Produk</span>
                        <span class="fw-semibold">Rp {{ number_format($total_harga, 0, ',', '.') }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-4">
                        <span class="text-muted">Biaya Pengiriman (Flat)</span>
                        <span class="fw-semibold">Rp {{ number_format($ongkir, 0, ',', '.') }}</span>
                    </div>
                    
                    <div class="d-flex justify-content-between border-top pt-3 mb-5">
                        <span class="fw-bold fs-5 text-dark">Total Pembayaran</span>
                        <span class="fw-bolder fs-4 text-success" id="total_bayar_text">Rp {{ number_format($total_bayar, 0, ',', '.') }}</span>
                        <input type="hidden" id="total_bayar_angka" value="{{ $total_bayar }}">
                    </div>

                    <button type="button" onclick="kirimKeWhatsApp()" class="btn btn-success btn-lg w-100 rounded-pill fw-bold py-3 shadow">
                        <i class="bi bi-whatsapp"></i> Pesan via WhatsApp
                    </button>
                    <p class="text-center text-muted small mt-3">
                        <i class="bi bi-shield-check"></i> Pesanan Anda akan dikonfirmasi manual via WhatsApp.
                    </p>
                </div>
            </div>

        </div>
    </form>
</div>

<script>
function kirimKeWhatsApp() {
    // 1. Ambil Data dari Form
    let nama = document.getElementById("nama").value;
    let nohp = document.getElementById("nohp").value;
    let alamat = document.getElementById("alamat").value;
    let catatan = document.getElementById("catatan").value;
    
    // Ambil Metode Pembayaran yang dipilih
    let metodePembayaran = document.querySelector('input[name="payment_method"]:checked');
    
    // Validasi Sederhana
    if (!nama || !nohp || !alamat) {
        alert("Mohon lengkapi Nama, No HP, dan Alamat Pengiriman.");
        return;
    }
    if (!metodePembayaran) {
        alert("Mohon pilih Metode Pembayaran.");
        return;
    }

    // 2. Ambil Data Produk
    let namaProduk = document.getElementById("nama_produk").innerText;
    let varian = document.getElementById("varian").innerText;
    let ukuran = document.getElementById("ukuran").innerText;
    let jumlah = document.getElementById("jumlah").innerText;
    let totalBayar = document.getElementById("total_bayar_text").innerText;

    // 3. Nomor WhatsApp Tujuan Admin / Owner (Sudah Diperbarui)
    let nomorAdmin = "6282132109959"; 

    // 4. Susun Pesan WhatsApp
    let pesan = `Halo Admin Barokah Jaya, saya ingin membuat pesanan:\n\n`;
    pesan += `*DETAIL PEMBELI*\n`;
    pesan += `- Nama: ${nama}\n`;
    pesan += `- No HP: ${nohp}\n`;
    pesan += `- Alamat: ${alamat}\n`;
    if (catatan) {
        pesan += `- Catatan: ${catatan}\n`;
    }
    
    pesan += `\n*DETAIL PESANAN*\n`;
    pesan += `- Produk: ${namaProduk}\n`;
    pesan += `- Warna: ${varian}\n`;
    pesan += `- Ukuran: ${ukuran}\n`;
    pesan += `- Jumlah: ${jumlah} pcs\n`;
    pesan += `- Total Bayar: *${totalBayar}*\n`;
    pesan += `- Metode Pembayaran: *${metodePembayaran.value}*\n\n`;

    if (metodePembayaran.value !== "Cash on Delivery (COD)") {
        pesan += `Mohon info nomor rekening / QRIS untuk pembayaran.\n`;
        pesan += `Saya akan segera mengirimkan bukti transfer di chat ini.\n\n`;
    }

    pesan += `Terima kasih!`;

    // 5. Encode Pesan ke URL
    let urlWhatsApp = `https://wa.me/${nomorAdmin}?text=${encodeURIComponent(pesan)}`;

    // 6. Buka WhatsApp
    window.open(urlWhatsApp, '_blank');
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>