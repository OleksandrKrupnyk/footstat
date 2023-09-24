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
        Schema::create('user_clubs', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index()->comment('User ID');
            $table->unsignedBigInteger('club_id')->index()->comment('Club ID');
            $table->timestamps();

            $table->foreign('club_id')
                ->references('id')
                ->on('clubs');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->unique(['user_id','club_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_clubs');
    }
};
