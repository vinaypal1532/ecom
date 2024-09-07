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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');       // Changed from 'sting' to 'string'
            $table->string('email');      // Changed from 'sting' to 'string'
            $table->string('mobile_no');  // Changed from 'sting' to 'string'
            $table->text('message');      // Changed from 'sting' to 'string', used 'text' for longer messages
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
