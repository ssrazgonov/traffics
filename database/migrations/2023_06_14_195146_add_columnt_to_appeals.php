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
        Schema::table('appeal', function (Blueprint $table) {
            $table->string('operator_comment')->nullable();
            $table->string('engineer_comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
