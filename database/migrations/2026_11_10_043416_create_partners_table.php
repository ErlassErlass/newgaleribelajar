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
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('kodlan', 50)->nullable()->unique();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('city', 100)->nullable();
            $table->string('province', 100)->nullable();
            $table->string('level', 20)->nullable(); // TK, SD, SMP, SMA, SMK, Umum
            $table->string('type', 30)->default('school'); // school, strategic, technology
            $table->string('logo_url')->nullable();
            $table->string('website')->nullable();
            $table->unsignedInteger('total_deals')->default(1);
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partners');
    }
};
