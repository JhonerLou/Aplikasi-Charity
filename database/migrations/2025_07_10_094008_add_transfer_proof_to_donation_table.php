<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donation', function (Blueprint $table) {
            $table->string('transfer_proof')->nullable();
            $table->string('payment_method')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('donation', function (Blueprint $table) {
            $table->dropColumn(['transfer_proof', 'payment_method']);
        });
    }
};
