<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tiket', function (Blueprint $table) {
            $table->id();
            $table->string('nomor', 20)->unique();
            $table->string('jenis', 20)->default('perbaikan');

            $table->foreignId('unit_id')->nullable()->constrained('unit')->restrictOnDelete();
            $table->string('nama_pelapor', 100)->nullable();
            $table->foreignId('dibuat_oleh_id')->nullable()->constrained('users')->restrictOnDelete();
            $table->string('kanal', 20)->nullable();

            $table->foreignId('kategori_id')->nullable()->constrained('kategori')->restrictOnDelete();
            $table->foreignId('jenis_keluhan_id')->nullable()->constrained('jenis_keluhan')->restrictOnDelete();
            $table->text('deskripsi');

            $table->foreignId('aset_id')->nullable()->constrained('aset')->restrictOnDelete();
            $table->foreignId('jadwal_pemeliharaan_id')->nullable()->constrained('jadwal_pemeliharaan')->restrictOnDelete();

            $table->string('prioritas', 10)->default('normal');
            $table->string('status', 20)->default('baru');
            $table->foreignId('penanggung_jawab_id')->nullable()->constrained('users')->restrictOnDelete();
            $table->string('cara_penanganan', 20)->nullable();
            $table->date('tanggal_jadwal')->nullable();

            $table->timestamp('waktu_diterima')->nullable();
            $table->timestamp('waktu_selesai')->nullable();
            $table->timestamp('batas_konfirmasi')->nullable();
            $table->timestamp('waktu_ditutup')->nullable();
            $table->string('cara_ditutup', 20)->nullable();

            $table->timestamps();

            $table->index('status');
            $table->index(['status', 'batas_konfirmasi']);
            $table->index('created_at');
        });

        Schema::create('penanganan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tiket_id')->unique()->constrained('tiket')->restrictOnDelete();
            $table->text('penyebab');
            $table->text('tindakan');
            $table->text('catatan_teknis')->nullable();
            $table->string('cara_penanganan_aktual', 20);
            $table->timestamps();
        });

        Schema::create('riwayat_tiket', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tiket_id')->constrained('tiket')->restrictOnDelete();
            $table->string('kejadian', 30);
            $table->string('nilai_lama', 100)->nullable();
            $table->string('nilai_baru', 100)->nullable();
            $table->text('alasan')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->restrictOnDelete();
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::create('lampiran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tiket_id')->constrained('tiket')->restrictOnDelete();
            $table->string('nama_file', 255);
            $table->string('path', 255);
            $table->string('tipe', 100);
            $table->unsignedInteger('ukuran');
            $table->foreignId('diunggah_oleh_id')->nullable()->constrained('users')->restrictOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lampiran');
        Schema::dropIfExists('riwayat_tiket');
        Schema::dropIfExists('penanganan');
        Schema::dropIfExists('tiket');
    }
};