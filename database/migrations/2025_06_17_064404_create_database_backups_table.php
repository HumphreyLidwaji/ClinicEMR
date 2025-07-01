<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
 public function up()
{
   Schema::create('database_backups', function (Blueprint $table) {
    $table->id();
    $table->string('file_name');
    $table->string('file_path');
    $table->timestamps(); // ← this adds both created_at and updated_at
});

}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('database_backups');
    }
};
