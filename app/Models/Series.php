<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use HasFactory;

    protected $fillable = ['workout_exercise_id', 'repetitions', 'weight', 'rpe', 'done'];

    /** Relations */
    public function workoutExercise() {
        return $this->belongsTo(WorkoutExercise::class);
    }
    
}
