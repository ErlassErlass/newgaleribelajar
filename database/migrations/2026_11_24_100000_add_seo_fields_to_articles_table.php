<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            // Hashtags without '#', e.g. ["ErlassAcademy","CodingAnak"]
            $table->json('tags')->nullable()->after('cover_image');
            // Optional SEO overrides; fall back to title/excerpt when empty
            $table->string('meta_title', 70)->nullable()->after('tags');
            $table->string('meta_description', 170)->nullable()->after('meta_title');
            $table->unsignedInteger('views')->default(0)->after('meta_description');
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn(['tags', 'meta_title', 'meta_description', 'views']);
        });
    }
};
