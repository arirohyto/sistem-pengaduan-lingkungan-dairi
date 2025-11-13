<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('riwayat_perubahan_status', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_id')->constrained('laporan')->onDelete('cascade');
            $table->enum('from_status', ['pending', 'diproses', 'selesai', 'ditolak'])->nullable();
            $table->enum('to_status', ['pending', 'diproses', 'selesai', 'ditolak']);
            $table->text('note')->nullable();
            $table->foreignId('changed_by')->constrained('users')->onDelete('cascade');
            $table->timestamp('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riwayat_perubahan_status');
    }
};