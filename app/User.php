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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $dates = [
        'born_at',
    ];

    protected $dateFormat = "Y-m-d";

    public function groups() {
        return $this->belongsToMany(Group::class);
    }

    public function setVotedAtAttribute(Carbon $date){
        $this->voted_at = $date->format('Y-m-d H:i:s');
    }

    public function getVotedAtAttribute($date){
        return Carbon::parse($date);
    }

    public function hasVoted() {
        return $this->voted_at != null;
    }
}
