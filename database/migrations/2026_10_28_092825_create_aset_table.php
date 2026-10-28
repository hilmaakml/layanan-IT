<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aset', function (Blueprint $table) {
            $table->id();
            $table->string('kode_inventaris', 50)->unique();
            $table->string('nama', 100);
            $table->string('kategori', 50);
            $table->string('merek_tipe', 100)->nullable();
            $table->string('nomor_seri', 100)->nullable();
            $table->foreignId('unit_id')->nullable()->constrained('unit')->restrictOnDelete();
            $table->string('lokasi', 150)->nullable();
            $table->string('kondisi', 20)->default('baik');
            $table->string('status', 20)->default('dipakai');
            $table->date('tanggal_perolehan')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aset');
    }
};