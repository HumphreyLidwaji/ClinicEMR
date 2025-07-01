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
    Schema::table('database_backups', function (Blueprint $table) {
        $table->string('restore_status')->nullable(); // e.g. "success" or "failed"
        $table->timestamp('restored_at')->nullable();
    });
}
    /**
     * Reverse the migrations.
     */
public function down()
{
    Schema::table('database_backups', function (Blueprint $table) {
        $table->dropColumn(['restore_status', 'restored_at']);
    });
}
};
