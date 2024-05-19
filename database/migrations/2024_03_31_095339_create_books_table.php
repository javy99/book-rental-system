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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('authors', 255);
            $table->text('description')->nullable();
            $table->date('released_at');
            $table->string('cover_image', 255)->nullable();
            $table->integer('pages');
            $table->string('language_code', 3)->default('hu');
            $table->string('isbn', 13)->unique();
            $table->integer('in_stock');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
