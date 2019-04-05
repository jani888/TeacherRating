<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{

    public function teachers() {
        return $this->belongsToMany(Teacher::class);
    }

    public function users() {
        return $this->belongsToMany(User::class);
    }
}
