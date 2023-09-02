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
        Schema::create('scales', function (Blueprint $table) {
            $table->id();
            $table->string('scale_type',8)
                ->index()->nullOnDelete()
                ->comment('Ref To ScaleType Type');
            $table->string('title')->comment('Title of Criterion');
            $table->string('description')->nullable()->comment("Description of Criterion");
            $table->unsignedInteger('max_value')->default(100)->comment('Maximum Value');
            $table->integer('offset')->default(0)->comment('Offset');
            $table->unsignedInteger('step')->default(1)->comment('Scale Step');
            $table->boolean('is_enable')->default(true)->comment('Is Scale Enable To Use?');
            $table->timestamps();

            $table->foreign('scale_type')
                ->references('type')->on('scale_types');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scales');
    }
};
