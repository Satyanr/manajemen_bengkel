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
        Schema::create('peralatan_atau_mesins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ruangan_id')->constrained('ruangans')->cascadeOnDelete();
            $table->string('kode_peralatan')->nullable();
            $table->string('nama_peralatan_atau_mesin');
            $table->string('harga')->nullable();
            $table->foreignId('kategori_id')->constrained('kategori_peralatan_atau_mesins')->cascadeOnDelete();
            $table->enum('status', ['Tersedia', 'Digunakan'])->default('Tersedia');
            $table->enum('keadaan', ['baik','sedang', 'rusak'])->default('baik');
            $table->enum('kondisi', ['ditempat','keluar'])->default('ditempat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peralatan_atau_mesins');
    }
};
