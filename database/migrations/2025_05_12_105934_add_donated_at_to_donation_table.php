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
        Schema::table('donation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('campaign_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 15, 2);
            $table->text('message')->nullable();
            $table->string('donor_name');
            $table->string('donor_email')->nullable();
            $table->boolean('is_anonymous')->default(false);
            $table->string('payment_status')->default('pending');
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
    }
};
