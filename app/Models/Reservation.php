<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = ['table_id', 'event_id', 'reserved_by', 'instagram_link', 'instagram_profile_picture'];

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
