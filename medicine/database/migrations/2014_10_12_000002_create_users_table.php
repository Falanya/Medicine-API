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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fullname', 255);
            $table->string('email', 255)->unique();
            $table->string('password', 255);
            $table->boolean('gender')->default(0);
            $table->string('phone',20);
            $table->string('address',255);
            $table->date('birthday')->nullable();
            $table->string('image',255)->nullable();
            $table->unsignedInteger('role_id')->default(1);
            $table->foreign('role_id')->references('id')->on('roles');
            $table->boolean('status')->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};