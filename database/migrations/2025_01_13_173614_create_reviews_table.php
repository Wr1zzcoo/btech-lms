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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('stars');
            $table->ForeignId('user_id');

            $table->string('title');
            $table->longText('description');

            $table->unsignedBigInteger('reviewable_id');

            $table->string('reviewable_type');

            $table->index(['reviewable_id', 'reviewable_type']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
