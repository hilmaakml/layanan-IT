<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jenis_keluhan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('kategori')->restrictOnDelete();
            $table->string('nama', 100);
            $table->string('prioritas_bawaan', 10)->default('normal');
            $table->text('saran_pelapor')->nullable();
            $table->boolean('aktif')->default(true);
            $table->timestamps();

            $table->unique(['kategori_id', 'nama']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jenis_keluhan');
    }
};