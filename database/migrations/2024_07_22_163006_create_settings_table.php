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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('business_name')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('address')->nullable();
            $table->string('gst_no')->nullable();
            $table->string('pan_card')->nullable();
            $table->string('logo')->nullable(); // Path to logo file
            $table->string('bank_account')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
