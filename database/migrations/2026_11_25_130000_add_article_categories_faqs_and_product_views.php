<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Article categories, managed by Admin / Super Admin (articles.category stores the slug)
        Schema::create('article_categories', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 60)->unique();
            $table->string('name', 100);
            $table->string('description', 300)->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
        $now = now();
        $i = 0;
        foreach ([
            'kompetisi' => 'Kompetisi',
            'kegiatan' => 'Dokumentasi Kegiatan',
            'artikel' => 'Berita & Artikel',
            'info-program' => 'Info Program',
        ] as $slug => $name) {
            DB::table('article_categories')->insert([
                'slug' => $slug, 'name' => $name, 'sort_order' => $i++, 'is_active' => true,
                'created_at' => $now, 'updated_at' => $now,
            ]);
        }

        // FAQs: scope "catalog" = Pertanyaan Seputar Katalog (/katalog);
        //       scope "product" = template for every product page (supports {produk}, {jenjang}, ... placeholders)
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('scope', 20)->index();
            $table->string('question', 255);
            $table->text('answer');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->unsignedInteger('views')->default(0)->after('deal_count');
            // template = template FAQ only, custom = this product's own FAQ only, both = template then custom
            $table->string('faq_mode', 10)->default('template')->after('views');
            $table->json('faqs')->nullable()->after('faq_mode');
        });
    }

    public function down(): void
    {
        Schema::table('products', fn (Blueprint $t) => $t->dropColumn(['views', 'faq_mode', 'faqs']));
        Schema::dropIfExists('faqs');
        Schema::dropIfExists('article_categories');
    }
};
