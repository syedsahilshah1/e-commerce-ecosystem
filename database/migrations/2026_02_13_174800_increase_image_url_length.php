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
            $table->text('image')->nullable()->change();
        });

        Schema::table('product_galleries', function (Blueprint $table) {
            $table->text('image_url')->change();
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->text('image')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('image', 255)->nullable()->change();
        });

        Schema::table('product_galleries', function (Blueprint $table) {
            $table->string('image_url', 255)->change();
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->string('image', 255)->nullable()->change();
        });
    }
};
