<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pakaian', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pakaian');
            $table->string('jenis');
            $table->string('ukuran');
            $table->string('warna')->nullable();
            $table->integer('harga');
            $table->integer('stok');
            $table->text('deskripsi')->nullable();
            $table->string('gambar')->nullable(); // Menyimpan URL gambar
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pakaian');
    }
};