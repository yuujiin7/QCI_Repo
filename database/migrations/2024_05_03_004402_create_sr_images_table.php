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
        Schema::create('sr_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_report_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->binary('image_data');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sr_images');
    }
};
