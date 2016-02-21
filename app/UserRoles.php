<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRoles extends Model
{
    protected $table = 'user_roles';
    protected $fillable = ['user_id', 'role_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function role()
    {
        return $this->belongsTo('App\Role');
    }
}
