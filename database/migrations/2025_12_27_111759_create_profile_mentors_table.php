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
        Schema::create('profile_mentors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('intern_id')->constrained('users');
            $table->unsignedBigInteger('nomor_induk');
            $table->unique('nomor_induk');
            $table->longText('foto');
            $table->string('no_telp', 225);
            $table->longText('alamat');
            $table->string('instansi', 225);
            $table->date('awal_magang');
            $table->date('akhir_magang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_mentors');
    }
};
