<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TrainingBlock;
use App\Models\WorkoutExercise;

class Workout extends Model
{
    use HasFactory;

    protected $fillable = ['training_block_id','date', 'name'];

    /** Relations */
    public function trainingBlock() {
        return $this->belongsTo(TrainingBlock::class);
    }
    public function workoutExercises() {
        return $this->hasMany(WorkoutExercise::class);
    }
    
}
