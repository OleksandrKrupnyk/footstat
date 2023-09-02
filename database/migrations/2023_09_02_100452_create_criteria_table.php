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
        Schema::create('criteria', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('scale_id')->index()->comment('Reference to scale');
            $table->string('title')->comment('Title of Criteria');
            $table->boolean('is_enable')->index()->default(true)->comment('Is Criterion Enable To Use?');
            $table->timestamps();

            $table->foreign('scale_id')
                ->references('id')
                ->on('scales');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('criteria');
    }
};
