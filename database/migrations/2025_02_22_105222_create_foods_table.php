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
            Schema::create('foods', function (Blueprint $table) {
                $table->id();
                $table->string('food_name');
                $table->string('food_type')->nullable();
                $table->decimal('food_price', 10, 2);
                $table->string('food_description')->nullable();
                $table->string('food_image')->nullable();
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foods');
    }
};
