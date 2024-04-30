<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Role;
use App\Models\CoachClient;
use App\Models\TrainingBlock;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /** Relations */
    public function role() {
        return $this->belongsTo(Role::class);
    }
    
    public function clients() {
        return $this->hasMany(CoachClient::class, 'coach_id');
    }

    public function coaches() {
        return $this->hasMany(CoachClient::class, 'client_id');
    }

    public function trainingBlocks() {
        return $this->hasMany(TrainingBlock::class, 'client_id');
    }
    

}
