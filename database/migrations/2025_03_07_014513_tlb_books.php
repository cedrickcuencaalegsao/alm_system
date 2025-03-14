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
        Schema::create('tbl_books', function (Blueprint $table) {
            $table->id();
            $table->string('bookID', 15)->nullable();
            $table->string('bookname', 50)->nullable();
            $table->string('bookdetails', 255)->nullable();
            $table->string('author', 25)->nullable();
            $table->unsignedBigInteger('stocks')->nullable();
            $table->string('bookcategory', 25)->nullable();
            $table->string('datepublish', 15)->nullable();
            $table->string('image', 25)->nullable();
            $table->double('bookprice')->nullable();
            $table->string('createdAt')->nullable();
            $table->string('updatedAt')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_books');
    }
};
