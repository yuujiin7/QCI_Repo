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
        Schema::table('service_reports', function (Blueprint $table) {
            
            $table->boolean('new_installation')->default(false);
            $table->boolean('under_maintenance')->default(false);
            $table->boolean('demo_poc')->default(false);
            $table->boolean('billable')->default(false);
            $table->boolean('under_warranty')->default(false);
            $table->boolean('corrective_maintenance')->default(false);
            $table->boolean('add_on')->default(false);
            $table->string('others')->nullable();
           
            

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_reports', function (Blueprint $table) {
            $table->dropColumn('new_installation');
            $table->dropColumn('under_maintenance');
            $table->dropColumn('demo_poc');
            $table->dropColumn('billable');
            $table->dropColumn('under_warranty');
            $table->dropColumn('corrective_maintenance');
            $table->dropColumn('add_on');
            $table->dropColumn('others');
            

        });
    }
};
