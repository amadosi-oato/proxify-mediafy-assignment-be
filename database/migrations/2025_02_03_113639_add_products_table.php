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
        Schema::create('products', function (Blueprint $table): void {
            $table->id();
            $table->string('feed_product_id')->nullable(false);
            $table->string('sku')->nullable(false);
            $table->string('name')->nullable(true);
            $table->integer('qty')->nullable(false)->default(0);
            $table->integer('status')->nullable(false)->default(0);
            $table->boolean('visibility')->nullable(false);
            $table->decimal('price')->default(0.00);
            $table->string('type_id')->nullable(false);
            $table->string('description')->nullable(false);
            $table->string('image')->nullable(true);
            $table->json('tags')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
