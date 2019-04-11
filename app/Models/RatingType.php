<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RatingType extends Model
{
    public $timestamps = false;

    protected $fillable = ['name', 'description'];

    public function getDeleteUrlAttribute() {
        return route('admin.rating_types.delete', ['rating_type_id' => $this->id]);
    }
}
