<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Columns of the homepage "Produk Digital di LMS" section; products join via products.lms_group = slug
        Schema::create('lms_groups', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 60)->unique();
            $table->string('title', 100);
            $table->string('description', 300)->nullable();
            $table->string('color', 20)->default('#219ebc');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Position of a product inside its LMS column
        Schema::table('products', function (Blueprint $table) {
            $table->integer('lms_order')->default(0)->after('lms_group');
        });

        $now = now();
        $groups = [
            ['intrakurikuler', 'Intrakurikuler dengan LMS', 'Mata pelajaran Informatika dan Koding & Kecerdasan Artifisial (KA) siap pakai untuk jam pelajaran reguler.', '#219ebc'],
            ['course', 'Course dengan LMS', 'Kursus mandiri berbasis proyek, lengkap dengan video, latihan, dan sertifikat.', '#fb8500'],
            ['asesmen', 'Asesmen dengan LMS', 'Asesmen potensi, minat, dan bakat siswa dengan laporan untuk sekolah dan orang tua.', '#023047'],
        ];
        foreach ($groups as $i => [$slug, $title, $desc, $color]) {
            DB::table('lms_groups')->insert([
                'slug' => $slug, 'title' => $title, 'description' => $desc, 'color' => $color,
                'sort_order' => $i, 'is_active' => true, 'created_at' => $now, 'updated_at' => $now,
            ]);

            // Keep today's order inside each column
            $ids = DB::table('products')->where('lms_group', $slug)->orderBy('sort_order')->orderBy('sku')->pluck('id');
            foreach ($ids as $pos => $id) {
                DB::table('products')->where('id', $id)->update(['lms_order' => $pos]);
            }
        }
    }

    public function down(): void
    {
        Schema::table('products', fn (Blueprint $t) => $t->dropColumn('lms_order'));
        Schema::dropIfExists('lms_groups');
    }
};
