<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donation', function (Blueprint $table) {
            $table->string('bank_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('account_holder_name')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('donation', function (Blueprint $table) {
            $table->dropColumn([
                'bank_name',
                'account_number',
                'account_holder_name'
            ]);
        });
    }
};
