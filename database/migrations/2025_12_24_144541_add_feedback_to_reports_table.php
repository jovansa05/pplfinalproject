<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->text('admin_note')->nullable()->after('status'); // Catatan admin / Alasan tolak
            $table->string('completion_proof')->nullable()->after('admin_note'); // Foto bukti selesai
        });
    }

    public function down()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropColumn(['admin_note', 'completion_proof']);
        });
    }
};
