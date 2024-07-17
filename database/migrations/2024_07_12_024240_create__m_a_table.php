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
            $table->string('start_date');
            $table->string('end_date');
            $table->string('distributior');
            $table->string('PO_number');
            $table->string('company_name');
            $table->string('project_name');
            $table->string('supp_acc_ref');
            $table->string('service_agreement');
            $table->string('model_description');
            $table->string('product_number');
            $table->string('service_level');
            $table->string('location');
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
