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
        Schema::table('products', function (Blueprint $table) {
            $table->index(['category_id', 'stock_quantity'], 'idx_category_stock');
            $table->index(['brand_id', 'stock_quantity'], 'idx_brand_stock');
            $table->index('sale_price', 'idx_sale_price');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->index(['status', 'created_at'], 'idx_order_status_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex('idx_category_stock');
            $table->dropIndex('idx_brand_stock');
            $table->dropIndex('idx_sale_price');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex('idx_order_status_date');
        });
    }
};
