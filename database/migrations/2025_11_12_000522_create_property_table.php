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
        Schema::create('properties', function (Blueprint $table) {
    $table->id();
    $table->foreignId('marketing_id')->constrained('users'); // Marketing yang upload
    $table->string('judul');
    $table->text('deskripsi');
    $table->decimal('harga', 15, 2);
    $table->string('alamat');
    $table->integer('luas_tanah')->nullable();
    $table->integer('luas_bangunan')->nullable();
    $table->string('gambar')->nullable(); // Path gambar
    $table->string('status')->default('pending'); // pending, approved, sold
    $table->timestamp('tanggal_upload')->useCurrent();
    $table->foreignId('approved_by')->nullable()->constrained('users'); // Admin/Ketua yang meng-acc
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
