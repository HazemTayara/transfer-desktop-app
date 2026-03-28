<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menafest_id')->constrained()->onDelete('cascade');
            $table->foreignId('driver_id')->nullable()->constrained()->nullOnDelete();
            $table->string('order_number');
            $table->string('content')->default('طرد');
            $table->integer('count')->default(1);
            $table->string('sender');
            $table->string('recipient');
            $table->string('pay_type')->default('مسبق'); // مسبق or تحصيل
            $table->decimal('amount', 10, 2)->default(0);
            $table->decimal('anti_charger', 10, 2)->default(0);
            $table->decimal('transmitted', 10, 2)->default(0);
            $table->decimal('miscellaneous', 10, 2)->default(0);
            $table->decimal('discount', 10, 2)->default(0);
            $table->boolean('is_paid')->default(false);
            $table->dateTime('paid_at')->nullable()->default(null);
            $table->boolean('is_exist')->default(true);
            $table->string('notes')->nullable()->default(null);
            $table->dateTime('assigned_at')->nullable()->default(null);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
