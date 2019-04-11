<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    protected $fillable = ['name', 'can_vote'];

    public function students() {
        return $this->hasMany(User::class);
    }
}
