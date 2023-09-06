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
        Schema::create('marks', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('club_id')->index()->comment('Club ID');
            $table->unsignedBigInteger('club_criteria_id')->index()->comment('Club Criteria ID');
            $table->unsignedBigInteger('user_id')->index()->comment('User ID');
            $table->string('scale_type',8)
                ->index()->nullOnDelete()
                ->comment('Ref To ScaleType Type');
            $table->unsignedInteger('mark_value')->index()->comment('Mark Value');
            $table->timestamps();
            //
            $table->foreign('scale_type')
                ->references('type')
                ->on('scale_types');

            $table->foreign('club_criteria_id')
                ->references('id')
                ->on('club_criteria');

            $table->foreign('club_id')
                ->references('id')
                ->on('clubs');

            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marks');
    }
};
