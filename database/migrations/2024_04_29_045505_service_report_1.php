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
            $table->id() -> first();
            $table->string('sr_number')->unique();
            $table->string('event_id')->nullable();
            $table->date('date');
            $table->string('customer_name');
            $table->string('address');
            $table->string('contact_person');
            $table->string('contact_number') -> nullable();
            $table->time('start_time');
            $table->time('end_time');
            $table->decimal('total_hours', 8, 2);
            $table->string('remarks') -> nullable();
            $table->string('machine_model')-> nullable();
            $table->string('machine_serial_number') -> nullable(); // to replace unique
            $table->string('product_number')->nullable(); // to replace unique
            $table->string('part_number') -> nullable();
            $table->string('part_quantity') -> nullable();
            $table->string('part_description') -> nullable();
            $table->string('part_usage') -> nullable();
            $table->text('action_taken');
            $table->string('pending')->nullable(); // Add nullable pending column
            $table->string('engineer_assigned');
            $table->string('tech_support') ;
            $table->string('hr_finance');
            $table->string('evp_coo');
            $table->boolean('new_installation')->default(false);
            $table->boolean('under_maintenance')->default(false);
            $table->boolean('demo_poc')->default(false);
            $table->boolean('billable')->default(false);
            $table->boolean('under_warranty')->default(false);
            $table->boolean('corrective_maintenance')->default(false);
            $table->boolean('add_on')->default(false);
            $table->string('others')->nullable();
            $table->boolean('is_complete')->default(false);
            $table->string('sr_image')->nullable();
            $table->string('problem_details')->nullable(); // Add nullable problem details column
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
