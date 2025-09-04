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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');          // Blog title
            $table->text('content');          // Blog body/content
            $table->foreignId('user_id')      // Author (must exist in users table)
                  ->constrained()
                  ->cascadeOnDelete();
            $table->timestamps();

            // Optional indexes if you like:
            // $table->index('user_id');
            // $table->index('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
