<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Direct link to this product's Shopee listing; null falls back to the store page
            $table->string('shopee_url', 500)->nullable()->after('cover_image');
            // Optional author/publisher line shown above the title (e.g. "Tim Erlass Academy")
            $table->string('author')->nullable()->after('name');
            $table->string('meta_title', 160)->nullable()->after('sort_order');
            $table->string('meta_description', 300)->nullable()->after('meta_title');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['shopee_url', 'author', 'meta_title', 'meta_description']);
        });
    }
};
