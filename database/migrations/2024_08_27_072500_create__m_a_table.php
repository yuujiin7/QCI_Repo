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
            $table->string('account_manager') -> nullable(); // Allow nullable account manager
            $table->string('account_manager_id') -> nullable(); // Removed unique constraint if multiple records per account manager are allowed
            $table->json('date_history'); // JSON column for storing multiple dates
            $table->date('start_date');
            $table->date('end_date');
            $table->string('distributor')-> nullable(); // Corrected typo: 'distributior' to 'distributor'
            $table->string('PO_number', 50)-> nullable(); // Defined length of PO number if needed
            $table->string('company_name') -> nullable();
            $table->string('project_name')-> nullable();
            $table->string('supp_acc_ref')-> nullable();
            $table->string('service_agreement')-> nullable();
            $table->string('model_description')-> nullable();
            $table->string('product_number')->nullable(); // Allow nullable product number
            $table->string('service_level')-> nullable();
            $table->string('location')-> nullable();
            $table->timestamps(); // Add created_at and updated_at columns
            $table->string('status')->default('active'); // Add default value for status column

            // Add foreign key constraint customer_id
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');

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
