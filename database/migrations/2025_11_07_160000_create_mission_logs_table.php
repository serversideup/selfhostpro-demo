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
        Schema::create('mission_logs', function (Blueprint $table) {
            $table->id();
            $table->string('mission_name');
            $table->string('destination');
            $table->integer('launch_year');
            $table->string('status'); // completed, active, planned
            $table->string('agency');
            $table->timestamp('logged_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mission_logs');
    }
};
