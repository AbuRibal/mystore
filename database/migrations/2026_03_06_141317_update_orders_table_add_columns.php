<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // إضافة الأعمدة المفقودة إذا لم تكن موجودة
            if (!Schema::hasColumn('orders', 'order_number')) {
                $table->string('order_number')->unique()->after('id');
            }
            if (!Schema::hasColumn('orders', 'customer_name')) {
                $table->string('customer_name')->after('order_number');
            }
            if (!Schema::hasColumn('orders', 'customer_phone')) {
                $table->string('customer_phone')->after('customer_name');
            }
            if (!Schema::hasColumn('orders', 'customer_email')) {
                $table->string('customer_email')->nullable()->after('customer_phone');
            }
            if (!Schema::hasColumn('orders', 'wilaya_id')) {
                $table->foreignId('wilaya_id')->constrained()->after('customer_email');
            }
            if (!Schema::hasColumn('orders', 'address')) {
                $table->text('address')->after('wilaya_id');
            }
            if (!Schema::hasColumn('orders', 'total')) {
                $table->decimal('total', 10, 2)->after('address');
            }
            if (!Schema::hasColumn('orders', 'status')) {
                $table->string('status')->default('pending')->after('total');
            }
            if (!Schema::hasColumn('orders', 'payment_method')) {
                $table->string('payment_method')->after('status');
            }
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'order_number',
                'customer_name',
                'customer_phone',
                'customer_email',
                'wilaya_id',
                'address',
                'total',
                'status',
                'payment_method'
            ]);
        });
    }
};