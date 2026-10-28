<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_pemeliharaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aset_id')->constrained('aset')->restrictOnDelete();
            $table->string('kegiatan', 150);
            $table->unsignedSmallInteger('interval_hari');
            $table->date('jatuh_tempo_berikutnya');
            $table->boolean('aktif')->default(true);
            $table->timestamps();

            $table->index(['aktif', 'jatuh_tempo_berikutnya']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_pemeliharaan');
    }
};