<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Workout;

class TrainingBlock extends Model
{
    use HasFactory;

    protected $fillable = ['client_id','name', 'description', 'start_date', 'end_date'];

    public $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    /** Relations */
    public function client() {
        return $this->belongsTo(User::class, 'client_id');
    }
    public function workouts() {
        return $this->hasMany(Workout::class);
    }
    
}
