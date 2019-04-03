<?php

namespace App;

use Carbon\Carbon;
use App\Models\Group;
use App\Models\Teacher;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'born_at', 'code', 'id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    protected $dates = [
        'voted_at'
    ];

    public function groups() {
        return $this->belongsToMany(Group::class);
    }

    public function hasVoted() {
        return $this->voted_at != null;
    }
}
