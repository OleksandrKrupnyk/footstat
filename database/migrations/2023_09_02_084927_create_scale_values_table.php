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
        Schema::create('scale_values', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('scale_id')->index()->comment('Reference to scale');
            $table->string('value',100)->comment('Value For Scale');
            $table->integer('num_value')->default(1)->comment('Numeric Value For Scale');
            $table->integer('position')->index()->default(0)->comment('Position For Sorting');
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
        Schema::dropIfExists('scale_values');
    }
};
