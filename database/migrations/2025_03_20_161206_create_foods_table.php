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
    Schema::create('imports_logs', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->enum('status', ['success', 'failure']);
      $table->string('file_name');
      $table->timestamps();
    });

    Schema::create('foods', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->uuid('import_id');
      $table->string('code');
      $table->enum('status', ['draft', 'trash', 'published']);
      $table->string('url')->unique();
      $table->string('creator');
      $table->unsignedBigInteger('created_t');
      $table->unsignedBigInteger('last_modified_t');
      $table->string('product_name');
      $table->string('quantity');
      $table->string('brands');
      $table->text('categories');
      $table->text('labels');
      $table->string('cities');
      $table->string('purchase_places');
      $table->string('stores');
      $table->text('ingredients_text');
      $table->text('traces');
      $table->string('serving_size');
      $table->decimal('serving_quantity', 8, 2)->nullable();
      $table->integer('nutriscore_score')->nullable();
      $table->string('nutriscore_grade', 1);
      $table->string('main_category');
      $table->string('image_url');

      $table->foreign('import_id')->references('id')->on('imports_logs');

      $table->timestamp('imported_t')->useCurrent();
      $table->timestamp('updated_at')->useCurrent();
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('foods');
  }
};
