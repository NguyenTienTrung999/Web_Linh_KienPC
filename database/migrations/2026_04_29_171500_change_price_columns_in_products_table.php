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
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE products MODIFY price DECIMAL(15, 2) NOT NULL, MODIFY sale_price DECIMAL(15, 2) NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE products MODIFY price DECIMAL(10, 2) NOT NULL, MODIFY sale_price DECIMAL(10, 2) NULL');
    }
};
