<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Satu checkout dipecah menjadi satu transaksi per toko, jadi tiap seller mengurus pesanannya sendiri
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->foreignId('store_id')->nullable()->after('user_id')->constrained()->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropConstrainedForeignId('store_id');
        });
    }
};
