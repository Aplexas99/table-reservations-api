<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class CoachClient extends Model
{
    use HasFactory;

    protected $fillable = ['coach_id', 'client_id'];

    /** Relations */
    public function coach() {
        return $this->belongsTo(User::class, 'coach_id');
    }
    
    public function client() {
        return $this->belongsTo(User::class, 'client_id');
    }
    
}
