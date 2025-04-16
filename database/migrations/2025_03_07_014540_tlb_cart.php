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
        Schema::create('tbl_cart', function (Blueprint $table) {
            $table->id();
            $table->string('cartID', 15)->nullable();
            $table->string('userID', 15)->nullable();
            $table->string('bookID', 15)->nullable();
            $table->boolean('isDeleted')->default(false);
            $table->string('createdAt')->nullable();
            $table->string('updatedAt')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_cart');
    }
};
