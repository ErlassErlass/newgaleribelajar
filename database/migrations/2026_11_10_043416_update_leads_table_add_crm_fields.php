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
        Schema::table('leads', function (Blueprint $table) {
            $table->string('sender_type', 50)->nullable()->after('type'); // school, education_office, institution, business_partner, parent, other
            $table->string('city', 100)->nullable()->after('school_name');
            $table->unsignedInteger('student_count')->nullable()->after('city');
            $table->boolean('consent_given')->default(true)->after('message');
            $table->string('status', 30)->default('new')->after('consent_given'); // new, contacted, quoted, won, lost
            $table->string('source', 100)->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->dropColumn(['sender_type', 'city', 'student_count', 'consent_given', 'status', 'source']);
        });
    }
};
