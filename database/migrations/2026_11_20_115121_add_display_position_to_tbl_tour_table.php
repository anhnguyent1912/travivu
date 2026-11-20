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
        Schema::table('tbl_tour', function (Blueprint $table) {
            if (!Schema::hasColumn('tbl_tour', 'display_position')) {
    Schema::table('tbl_tour', function (Blueprint $table) {
        // Cột mới: tour hiện ở trang chủ, trang tour, hay cả hai
        $table->string('display_position', 10)->default('both');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_tour', function (Blueprint $table) {
            Schema::table('tbl_tour', function (Blueprint $table) {
    $table->dropColumn('display_position');
        });
    }
};
