<?php

use App\Models\User;

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
        Schema::create('borrow_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('book_id');

            $table->timestamp('borrowed_at')
                ->nullable()
                ->default(null);

                $table->timestamp('return_by')
                ->nullable()
                ->default(null);

                $table->timestamp('returned_at')
                ->nullable()
                ->default(null);

            $table->string('status');

            $table->foreignIdFor(User::class, 'accepted_by_id')
                ->nullable()
                ->default(null);

            $table->timestamp('accepted_at')
                ->nullable()
                ->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrow_transactions');
    }
};
