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
        Schema::create('promotions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 255)->unique();
            $table->string('name')->nullable();
            $table->integer('max_users')->nullable();
            $table->integer('max_users_user')->nullable();
            $table->string('description')->nullable();
            $table->double('discount_amount');
            $table->double('min_amount')->nullable();
            $table->enum('type',['percent','fixed'])->default('fixed');
            $table->integer('status')->default(1);
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
