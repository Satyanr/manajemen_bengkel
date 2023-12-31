<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengajuan_alat_atau_bahans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->enum('kode', ['A', 'B']);
            $table->string('kode_barang')->nullable();
            $table->string('nama_alat_atau_bahan');
            $table->string('volume');
            $table->string('satuan');
            $table->string('merk');
            $table->string('type_atau_model');
            $table->string('dimensi')->nullable();
            $table->string('gambar')->nullable();
            $table->foreignId('guru_id')->constrained('gurus')->onDelete('cascade');
            $table->foreignId('sekolah_id')->constrained('sekolahs')->onDelete('cascade');
            $table->enum('status', ['Pending', 'Diterima', 'Ditolak'])->default('Pending');
            $table->enum('keadaan', ['baik','rusak ringan', 'rusak berat'])->default('baik');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_alat_atau_bahans');
    }
};
