<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Workout;
use App\Models\Exercise;
use App\Models\Series;

class WorkoutExercise extends Model
{
    use HasFactory;

    protected $fillable = ['workout_id', 'exercise_id'];

    /** Relations */
    public function workout() {
        return $this->belongsTo(Workout::class);
    }
    public function exercise() {
        return $this->belongsTo(Exercise::class);
    }
    public function series() {
        return $this->hasMany(Series::class);
    }
}
