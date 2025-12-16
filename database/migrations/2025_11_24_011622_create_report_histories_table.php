<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('report_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('report_id');
            $table->string('old_status')->nullable();
            $table->string('new_status');
            $table->text('admin_note')->nullable();
            $table->string('proof_photo')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('report_id')->references('id')->on('reports')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('report_histories');
    }
};