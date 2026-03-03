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
        Schema::table('candidate_interns', function (Blueprint $table) {
            $table->foreignId('lowongan_id')->nullable()->constrained('lowongans')->nullOnDelete()->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidate_interns', function (Blueprint $table) {
            $table->dropForeign(['lowongan_id']);
            $table->dropColumn('lowongan_id');
        });
    }
};
