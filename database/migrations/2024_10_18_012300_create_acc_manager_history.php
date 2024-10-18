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
        Schema::table('maintenance_agreements', function (Blueprint $table) {
            // add account manager history column
            $table->json('account_manager_history')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('maintenance_agreements', function (Blueprint $table) {
            //
            $table->dropColumn('account_manager_history');
        });
    }
};
