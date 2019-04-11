<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{

    protected $fillable = ['name'];

    public function groups() {
        return $this->belongsToMany(Group::class);
    }

    public function ratings() {
        return $this->hasMany(Rating::class);
    }

    public function scopeFindByName($query, $name) {
        return $query->where('name', $name);
    }
}
