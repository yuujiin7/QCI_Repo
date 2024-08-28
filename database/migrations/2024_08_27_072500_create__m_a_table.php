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
            $table->string('serial_number')->unique(); // Unique constraint on serial number
            $table->string('account_manager');
            $table->string('account_manager_id'); // Removed unique constraint if multiple records per account manager are allowed
            $table->json('date_history'); // JSON column for storing multiple dates
            $table->date('start_date');
            $table->date('end_date');
            $table->string('distributor'); // Corrected typo: 'distributior' to 'distributor'
            $table->string('PO_number', 50); // Defined length of PO number if needed
            $table->string('company_name');
            $table->string('project_name');
            $table->string('supp_acc_ref');
            $table->string('service_agreement');
            $table->string('model_description');
            $table->string('product_number')->nullable(); // Allow nullable product number
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
