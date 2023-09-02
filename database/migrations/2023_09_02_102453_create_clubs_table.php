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
        Schema::create('clubs', static function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('Title of Club');
            $table->string('country_code',2)->index()->comment('County Code');
            $table->string('emblem')->nullable()->comment('Emblem File Name');
            $table->string('owners')->nullable()->comment('Owners');
            $table->string('capitan')->nullable()->comment('Capitan');
            $table->string('manager')->nullable()->comment('Manager');
            $table->string('ceo')->nullable()->comment('CEO');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clubs');
    }
};
