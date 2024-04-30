<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Workout;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'category_id'];

    /** Relations */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function workouts() {
        return $this->belongsToMany(Workout::class, 'workout_exercises');
    }
    

}
