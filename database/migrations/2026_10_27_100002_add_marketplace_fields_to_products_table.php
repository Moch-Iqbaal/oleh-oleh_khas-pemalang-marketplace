<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // nullable hanya supaya bisa ditambahkan ke tabel lama; validasi tetap mewajibkan
            $table->foreignId('store_id')->nullable()->after('id')->constrained()->restrictOnDelete();
            $table->unsignedInteger('weight_grams')->default(0)->after('stock');
            $table->unsignedSmallInteger('shelf_life_days')->nullable()->after('weight_grams');
            $table->boolean('is_featured')->default(false)->after('shelf_life_days');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropConstrainedForeignId('store_id');
            $table->dropColumn(['weight_grams', 'shelf_life_days', 'is_featured']);
        });
    }
};
