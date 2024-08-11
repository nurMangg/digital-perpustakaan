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
        Schema::create('dp_buku', function (Blueprint $table) {
            $table->increments('bukuId');
            $table->string('bukuNama');
            $table->string('bukuIdKategori');
            $table->string('bukuDeskripsi')->nullable();
            $table->string('bukuJumlah');
            $table->string('bukuPdf')->nullable();
            $table->longText('bukuCover')->nullable();

            $table->unsignedBigInteger('user_id');
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dp_buku');
    }
};
