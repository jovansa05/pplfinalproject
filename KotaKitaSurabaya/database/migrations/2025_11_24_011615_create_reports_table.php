<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();

            // Nomer Tiket Unik
            $table->string('ticket_number')->unique();
            
            // Relasi ke User & Category
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            
            // Data Laporan
            $table->string('image');        // Foto Bukti
            $table->text('description');    // Deskripsi
            $table->string('location');     // Alamat / Lokasi
            
            // Koordinat 
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            
            // Status Laporan
            $table->enum('status', ['pending', 'proses', 'selesai'])->default('pending');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};