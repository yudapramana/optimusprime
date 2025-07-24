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
        Schema::create('receipt_signatures', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // nama terang
            $table->string('signature_url'); // URL tanda tangan
            $table->string('position')->nullable(); // opsional: jabatan
            $table->boolean('is_active')->default(false); // untuk aktifkan tanda tangan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipt_signatures');
    }
};
