<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('brand_id');

            $table->string('name');
            $table->string('slug')->unique();
            $table->decimal('price', 15, 2);
            $table->decimal('old_price', 15, 2)->nullable();
            $table->integer('quantity')->default(0);
            $table->string('image')->nullable();

            $table->string('cpu')->nullable();
            $table->string('ram')->nullable();
            $table->string('storage')->nullable();
            $table->string('screen')->nullable();
            $table->string('gpu')->nullable();
            $table->string('os')->nullable();
            $table->decimal('weight', 8, 2)->nullable();

            $table->text('description')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamps();

            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};