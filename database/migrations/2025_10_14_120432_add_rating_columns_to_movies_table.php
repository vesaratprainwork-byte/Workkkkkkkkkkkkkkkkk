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
        Schema::table('movies', function (Blueprint $table) {
            $table->decimal('average_rating', 3, 2)->default(0); // คะแนนเฉลี่ย ทศนิยม 2 ตำแหน่ง
            $table->integer('reviews_count')->default(0); // จำนวนรีวิวทั้งหมด
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('movies', function (Blueprint $table) {
            $table->dropColumn('average_rating');
            $table->dropColumn('reviews_count');
        });
    }
};