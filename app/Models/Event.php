<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'date'];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    /* Scopes */
    //filters
    public function scopeWhereName($query, $name)
    {
        return $query->where('name', 'like', '%' . $name . '%');
    }

    //sorts
    public function scopeOrderByName($query, $direction = 'asc')
    {
        return $query->orderBy('name', $direction);
    }
    public function scopeOrderByDate($query, $direction = 'asc')
    {
        return $query->orderBy('date', $direction);
    }
}
