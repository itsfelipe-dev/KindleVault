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
        Schema::create('highlights', function (Blueprint $table) {
            $table->id();
            $table->longText('text');
            $table->text('location');
            $table->string('chapter');
            $table->string('color')->nullable();
            $table->boolean('is_favorite')->default(false);
            $table->timestamp('clipped_at')->nullable();
            $table->foreignId('book_id');
            $table->foreignId('user_id');
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('highlights');
    }
};
