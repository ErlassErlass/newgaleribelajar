<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Sold on the official Shopee store (shows the Shopee badge & button)
            $table->boolean('on_shopee')->default(false)->after('shopee_url');
            // Delivered through the Erlass Academy LMS platform (erlass.academy)
            $table->boolean('on_lms')->default(false)->after('on_shopee');
            $table->string('lms_url', 500)->nullable()->after('on_lms');
            $table->boolean('is_free')->default(false)->after('lms_url');
            // Groups products on the homepage LMS section: intrakurikuler, course, asesmen, sumber-guru
            $table->string('lms_group', 30)->nullable()->after('is_free');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['on_shopee', 'on_lms', 'lms_url', 'is_free', 'lms_group']);
        });
    }
};
