<?php

use App\Support\EnglishContent;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // English versions shown when a visitor picks EN; empty = the Indonesian text is shown
        Schema::table('products', function (Blueprint $table) {
            $table->text('summary_en')->nullable()->after('summary');
            $table->text('description_en')->nullable()->after('description');
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->string('title_en')->nullable()->after('title');
            $table->text('excerpt_en')->nullable()->after('excerpt');
            $table->longText('body_en')->nullable()->after('body');
        });

        // Translate the existing catalog and articles (only fills empty English fields)
        EnglishContent::fill();
    }

    public function down(): void
    {
        Schema::table('products', fn (Blueprint $table) => $table->dropColumn(['summary_en', 'description_en']));
        Schema::table('articles', fn (Blueprint $table) => $table->dropColumn(['title_en', 'excerpt_en', 'body_en']));
    }
};
