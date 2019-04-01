<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = ['teacher_id', 'value', 'rating_type_id'];

    protected $dateFormat = 'Y-m-d H:i:s';
}
