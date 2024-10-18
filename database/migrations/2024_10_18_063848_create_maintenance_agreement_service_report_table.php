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
        Schema::create('maintenance_agreement_service_report', function (Blueprint $table) {
            $table->id();
            $table->foreignId('maintenance_agreement_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_report_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_agreement_service_report');
    }
};
