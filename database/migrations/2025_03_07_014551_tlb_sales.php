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
        Schema::create('tbl_sales', function (Blueprint $table) {
            $table->id();
            $table->string('salesID', 15)->nullable();
            $table->string('bookID', 15)->nullable();
            $table->string('userID', 15)->nullable();
            $table->unsignedInteger('quantity')->nullable();
            $table->unsignedInteger('booksold')->nullable();
            $table->string('status', 15)->nullable(); // pending, delivered, delivering,or cancelled.
            $table->double('tax')->nullable();
            $table->double('totalsales')->nullable();
            $table->string('createdAt')->nullable();
            $table->string('updatedAt')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_sales');
    }
};
