<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $guarded = [];

    public function getEditUrlAttribute(){
        return route('admin.admins.edit', ['user_id' => $this->id]);
    }

    public function getUpdateUrlAttribute(){
        return route('admin.admins.update', ['user_id' => $this->id]);
    }

    public function getDeleteUrlAttribute(){
        return route('admin.admins.delete', ['user_id' => $this->id]);
    }
}
