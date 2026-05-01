<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('coupons', function (Blueprint $table) {
            $table->decimal('min_order_value', 15, 2)->default(0)->after('discount_type');
            $table->integer('usage_limit')->nullable()->after('min_order_value');
            $table->integer('used_count')->default(0)->after('usage_limit');
            $table->dateTime('valid_from')->nullable()->after('used_count');
            $table->dateTime('valid_to')->nullable()->after('valid_from');
            
            // Drop old expiry_date column
            if (Schema::hasColumn('coupons', 'expiry_date')) {
                $table->dropColumn('expiry_date');
            }
        });
    }

    public function down(): void
    {
        Schema::table('coupons', function (Blueprint $table) {
            $table->date('expiry_date')->nullable();
            
            $table->dropColumn([
                'min_order_value',
                'usage_limit',
                'used_count',
                'valid_from',
                'valid_to',
            ]);
        });
    }
};
