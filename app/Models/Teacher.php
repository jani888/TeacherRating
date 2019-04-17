<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $with = ['ratings'];

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

    public function getRatingAverageAttribute() {
        return $this->relations['ratings']->count() == 0 ? 0 : $this->relations['ratings']->sum('value') / $this->relations['ratings']->count();
    }
}
