<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporan', function (Blueprint $table) {
            $table->id();
            $table->string('code', 30)->unique();
            $table->string('title', 150);
            $table->text('description');
            $table->foreignId('category_id')->constrained('kategori')->onDelete('restrict');
            $table->enum('status', ['pending', 'diproses', 'selesai', 'ditolak'])->default('pending');
            $table->foreignId('reporter_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('reporter_name', 100)->nullable();
            $table->string('reporter_email', 190)->nullable();
            $table->string('reporter_phone', 30)->nullable();
            $table->boolean('is_anonymous')->default(false);
            $table->foreignId('location_id')->constrained('lokasi')->onDelete('restrict');
            $table->foreignId('area_id')->constrained('area')->onDelete('restrict');
            $table->string('address', 255)->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};