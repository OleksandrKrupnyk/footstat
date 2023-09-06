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
        Schema::create('club_criteria', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('club_id')->index()->comment('Club ID');
            $table->unsignedBigInteger('criterion_id')->index()->comment('Scale ID');
            $table->timestamps();

            $table->foreign('criterion_id')
                ->references('id')
                ->on('criteria');
            $table->foreign('club_id')
                ->references('id')
                ->on('clubs');
            $table->unique(['criterion_id','club_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('club_criteria');
    }
};
