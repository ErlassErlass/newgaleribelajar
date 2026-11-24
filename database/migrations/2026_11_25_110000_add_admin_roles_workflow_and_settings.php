<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Roles: super_admin | admin | writer
        Schema::table('users', function (Blueprint $table) {
            $table->string('role', 20)->default('writer')->after('email')->index();
            $table->boolean('is_active')->default(true)->after('role');
        });
        // Existing accounts were created as full admins
        DB::table('users')->update(['role' => 'super_admin']);

        // Article review workflow: draft -> review -> published | rejected
        Schema::table('articles', function (Blueprint $table) {
            $table->string('status', 20)->default('draft')->after('category')->index();
            $table->foreignId('author_id')->nullable()->after('status')->constrained('users')->nullOnDelete();
            $table->foreignId('reviewed_by')->nullable()->after('author_id')->constrained('users')->nullOnDelete();
            $table->timestamp('reviewed_at')->nullable()->after('reviewed_by');
            $table->string('review_note', 500)->nullable()->after('reviewed_at');
        });
        DB::table('articles')->where('is_published', true)->update(['status' => 'published']);

        // Comment moderation + consent for promotional use of the commenter's email
        Schema::table('article_comments', function (Blueprint $table) {
            $table->boolean('is_flagged')->default(false)->after('is_approved')->index();
            $table->string('flag_reason')->nullable()->after('is_flagged');
            $table->boolean('marketing_consent')->default(false)->after('flag_reason');
        });

        // One row per email collected from comments, newsletter and consultation forms
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('name')->nullable();
            $table->string('phone', 30)->nullable();
            $table->json('sources')->nullable();          // ["komentar","newsletter","konsultasi"]
            $table->boolean('marketing_consent')->default(false)->index();
            $table->unsignedInteger('comment_count')->default(0);
            $table->timestamp('first_seen_at')->nullable();
            $table->timestamp('last_seen_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // Site-wide settings editable from the admin panel (override config/erlass.php)
        Schema::create('settings', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->json('value')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
        Schema::dropIfExists('contacts');
        Schema::table('article_comments', fn (Blueprint $t) => $t->dropColumn(['is_flagged', 'flag_reason', 'marketing_consent']));
        Schema::table('articles', function (Blueprint $table) {
            $table->dropConstrainedForeignId('author_id');
            $table->dropConstrainedForeignId('reviewed_by');
            $table->dropColumn(['status', 'reviewed_at', 'review_note']);
        });
        Schema::table('users', fn (Blueprint $t) => $t->dropColumn(['role', 'is_active']));
    }
};
