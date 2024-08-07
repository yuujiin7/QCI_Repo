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
            $table->id(); // Primary key column
            $table->string('serial_number')->unique(); // Unique constraint
            $table->string('account_manager');
            // Account manager user id with unique constraint
            $table->string('account_manager_id')->unique(); 
            $table->json('date_history'); // JSON column for storing multiple dates
            $table->date('start_date');
            $table->date('end_date');
            $table->string('distributor'); // Corrected typo: 'distributior' to 'distributor'
            $table->string('PO_number');
            $table->string('company_name');
            $table->string('project_name');
            $table->string('supp_acc_ref');
            $table->string('service_agreement');
            $table->string('model_description');
            $table->string('product_number');
            $table->string('service_level');
            $table->string('location');
            $table->timestamps(); // Add created_at and updated_at columns
            $table->string('status')->default('active'); // Add default value for status column
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
