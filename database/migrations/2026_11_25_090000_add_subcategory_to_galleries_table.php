<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('galleries', function (Blueprint $table) {
            // category = main group slug (guru, umum, siswa, anak, festival); subcategory = slug inside it.
            // Both are defined in config/gallery.php.
            $table->string('subcategory', 60)->nullable()->after('category');
            $table->string('description', 300)->nullable()->after('title');
            $table->date('taken_at')->nullable()->after('subcategory');
            $table->index(['category', 'subcategory']);
        });
    }

    public function down(): void
    {
        Schema::table('galleries', function (Blueprint $table) {
            $table->dropIndex(['category', 'subcategory']);
            $table->dropColumn(['subcategory', 'description', 'taken_at']);
        });
    }
};
