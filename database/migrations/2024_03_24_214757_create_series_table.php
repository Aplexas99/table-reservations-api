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
        Schema::create('series', function (Blueprint $table) {
        $table->id();
        $table->foreignId('workout_exercise_id')->constrained('workout_exercises');
        $table->integer('repetitions');
        $table->decimal('weight', 8, 2);
        $table->integer('rpe')->nullable();
        $table->boolean('done')->default(false);
        $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('series');
    }
};
