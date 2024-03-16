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
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('type_id');
            $table->foreign('type_id')->references('id')->on('product_types');
            $table->string('name', 255);
            $table->text('describe');
            $table->text('info');
            $table->double('quantity');
            $table->double('view')->default(0);
            $table->double('price');
            $table->double('discount')->default(0);
            $table->string('img', 255);
            $table->string('slug', 255)->unique();
            $table->boolean('status')->default(1);
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