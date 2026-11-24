<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            // Pinned articles are listed above all others; the most recently pinned comes first
            $table->boolean('is_pinned')->default(false)->after('is_published')->index();
            $table->timestamp('pinned_at')->nullable()->after('is_pinned');
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropIndex(['is_pinned']);
            $table->dropColumn(['is_pinned', 'pinned_at']);
        });
    }
};
