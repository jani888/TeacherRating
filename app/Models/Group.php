<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{

    public function teacher() {
        return $this->belongsTo(Teacher::class);
    }

    public function users() {
        return $this->belongsToMany(User::class);
    }
}
