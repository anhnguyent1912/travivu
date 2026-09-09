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
    Schema::create('tbl_tour', function (Blueprint $table) {
        $table->id('tourId'); // Tạo khóa chính tự động tăng
        $table->string('title', 255);
        $table->text('description')->nullable();
        $table->string('images', 255)->nullable();
        $table->integer('quantity')->default(0);
        $table->integer('priceAdult')->default(0);
        $table->integer('priceChild')->default(0);
        $table->string('destination', 255)->nullable();
        $table->integer('availability')->default(0);
        $table->text('itinerary')->nullable();
        $table->date('startDate')->nullable();
        $table->date('endDate')->nullable();
        $table->text('reviews')->nullable();
        
        $table->timestamps(); // Tự động tạo 2 cột created_at và updated_at
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_tour');
    }
};
