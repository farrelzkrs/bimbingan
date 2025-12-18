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
        Schema::create('bimbingans', function (Blueprint $table) {
            $table->id();
            // Foreign key to skripsis table
            $table->foreignId('skripsi_id')->constrained('skripsis')->onDelete('cascade');
            // Foreign key to dosens table
            $table->foreignId('dosen_id')->constrained('dosens')->onDelete('cascade');
            
            $table->text('catatan')->nullable();
            $table->string('file_surat')->nullable();
            $table->string('status')->default('pending'); // Adjust default as needed
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bimbingans');
    }
};
