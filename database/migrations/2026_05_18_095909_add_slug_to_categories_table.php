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
        Schema::table('categories', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('name');
        });

        // Tự động tạo slug cho các category đã có
        $categories = \Illuminate\Support\Facades\DB::table('categories')->get();
        foreach ($categories as $cat) {
            \Illuminate\Support\Facades\DB::table('categories')
                ->where('id', $cat->id)
                ->update(['slug' => \Illuminate\Support\Str::slug($cat->name)]);
        }

        // Bắt buộc NOT NULL và Unique
        Schema::table('categories', function (Blueprint $table) {
            $table->string('slug')->nullable(false)->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
