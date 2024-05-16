<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('service_reports', function (Blueprint $table) {
            $table->id();
            $table->string('sr_number')->unique();
            $table->string('event_id')->unique() -> nullable();
            $table->date('date');
            $table->string('customer_name');
            $table->string('address');
            $table->string('contact_person');
            $table->string('contact_number')->unique();
            $table->time('start_time');
            $table->time('end_time');
            $table->decimal('total_hours', 8, 2); // Define total_hours as a decimal
            $table->string('remarks');
            $table->string('status_1') -> nullable();
            $table->string('machine_model') -> unique() -> nullable();
            $table->string('machine_serial_number')->unique() -> nullable();
            $table->string('product_number')->unique() -> nullable();
            $table->string('part_number') -> nullable();
            $table->string('part_quantity') -> nullable();
            $table->string('part_description') -> nullable();
            $table->string('part_usage') -> nullable();
            $table->string('action_taken');
            $table->string('pending');
            $table->string('status_2');
            $table->string('engineer_assigned');
            $table->string('tech_support');
            $table->string('hr_finance');
            $table->string('evp_coo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_reports');
    }

};
