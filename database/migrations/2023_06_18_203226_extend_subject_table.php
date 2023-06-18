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
        //
        Schema::table('subject', function (Blueprint $table) {
            $table->unsignedBigInteger('teacher_id');

            $table->foreign('teacher_id')->references('id')->on('teacher')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('subject', function (Blueprint $table) {
            $table->dropColumn('teacher_id');
        });
    }
};
