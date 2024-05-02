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
        Schema::create('service_reports', function (Blueprint $table) {
            $table->id();
            $table->string('sr_number')->unique();
            $table->string('event_id')->unique();
            $table->date('date');
            $table->string('customer_name');
            $table->string('address');
            $table->string('contact_person');
            $table->string('contact_number')->unique();
            $table->time('start_time');
            $table->time('end_time');
            $table->decimal('total_hours', 8, 2); // Define total_hours as a decimal
            $table->string('remarks');
            //array of status
            // $table->array('status_1');
            $table->string('status_1');
            $table->string('machine_model');
            $table->string('machine_serial_number')->unique();
            $table->string('product_number')->unique();
            $table->string('part_number');
            $table->string('part_quantity');
            $table->string('part_description');
            $table->string('part_usage');
            $table->string('action_taken');
            $table->string('pending');
            $table->string('status_2');
            $table->string('engineer_assigned');
            $table->string('tech_support');
            $table->string('hr_finance');
            $table->string('evp_coo');
            // file upload
            $table->string('file_upload');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('service_reports', function (Blueprint $table) {
        //     //
        // });
        Schema::dropIfExists('service_reports');
    }

};
