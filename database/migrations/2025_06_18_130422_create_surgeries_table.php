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
       Schema::create('surgeries', function (Blueprint $table) {
    $table->id();
    $table->string('patient_name');
    $table->string('surgery_type');
    $table->date('scheduled_date')->nullable();
    $table->dateTime('performed_at')->nullable();
    $table->text('report')->nullable();
    $table->string('status')->default('requested'); // requested, scheduled, performed
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surgeries');
    }
};
