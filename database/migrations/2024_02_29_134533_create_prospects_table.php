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
    Schema::create('prospects', function (Blueprint $table) {
      $table->id();
      $table->string('first_name')->index();
      $table->string('last_name')->index();
      $table->string('company_email')->index();
      $table->string('linkedin_url')->default('')->index();
      $table->json('meta');
      $table->timestamps();

      $table->index(['created_at', 'updated_at']);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('prospects');
  }
};
