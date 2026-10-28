<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('peran', 10)->default('unit')->after('email');
            $table->foreignId('unit_id')->nullable()->after('peran')->constrained('unit')->restrictOnDelete();
            $table->string('bidang', 50)->nullable()->after('unit_id');
            $table->boolean('aktif')->default(true)->after('bidang');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('unit_id');
            $table->dropColumn(['peran', 'bidang', 'aktif']);
        });
    }
};