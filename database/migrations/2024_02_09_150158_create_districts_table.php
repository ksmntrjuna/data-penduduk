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
        Schema::create('districts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('province_id'); // Kolom untuk menunjukkan provinsi di mana kabupaten tersebut berada
            $table->timestamps();

            // Definisi foreign key
            $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade');
            // Maksud dari onDelete('cascade') adalah jika provinsi dihapus, semua kabupaten yang terkait juga akan dihapus.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('districts');
    }
};
