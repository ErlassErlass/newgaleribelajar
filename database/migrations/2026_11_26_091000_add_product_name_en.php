<?php

use App\Support\EnglishContent;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // English product name (empty = the original name is shown, e.g. brand names)
        Schema::table('products', function (Blueprint $table) {
            $table->string('name_en')->nullable()->after('name');
        });

        // Fill English names and redo the auto-translated summaries/descriptions so they use the
        // English name. Texts an admin has edited are left alone.
        EnglishContent::fill(refreshGenerated: true);
    }

    public function down(): void
    {
        Schema::table('products', fn (Blueprint $table) => $table->dropColumn('name_en'));
    }
};
