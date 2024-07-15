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
        Schema::create('maintenance_agreements', function (Blueprint $table) {
            $table->id();
            $table->string('serial_number') -> unique();
            $table->string('account_manager');
            //account manager user id
            $table->id('account_manager_id');
            $table->string('date_history') -> array();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_agreements');
        
    }
};
