<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('scale_types', function (Blueprint $table) {
            $table->id();
            $table->string('type', 8)->index()->unique()->comment('Type Of ScaleType');
            $table->string('title')->nullable()->comment('Title of ScaleType');
            $table->timestamps();
        });
        $time = Carbon::now();
        DB::table('scale_types')->insert([
            ['type' => 'NUMBER', 'title' => "Шкала цифрова", "created_at" => $time, "updated_at" => $time],
            ['type' => 'RANGE', 'title' => "Шкала визначених значень", "created_at" => $time, "updated_at" => $time],
            ['type' => 'BOOLEAN', 'title' => "Бінарна шкала", "created_at" => $time, "updated_at" => $time],
        ]);


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scales');
    }
};
