<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Audit trail: who changed what in the admin panel (only for important data, see LogsActivity)
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('user_name')->nullable();      // kept even if the account is deleted later
            $table->string('user_role', 20)->nullable();
            $table->string('event', 30)->index();         // created | updated | deleted | login | login_failed | logout | export
            $table->string('subject_type')->nullable();   // model class
            $table->string('subject_id', 64)->nullable();
            $table->string('subject_label')->nullable();  // e.g. article title, setting name
            $table->json('changes')->nullable();          // {field: {old, new}}
            $table->string('description', 500)->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->timestamp('created_at')->useCurrent()->index();

            $table->index(['subject_type', 'subject_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
