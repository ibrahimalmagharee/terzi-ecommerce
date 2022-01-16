<?php

namespace App\Models;

use App\Notifications\Admin\ResetPasswordNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable , SoftDeletes;

    protected $table = "admins";
    protected $guarded = [];
    public $timestamps = true;

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function hasAbility($permissions)
    {
        $role = $this->role;

        if (!$role) {
            return false;
        }

        foreach ($role->permissions as $permission) {
            if (is_array($permissions) && in_array($permission->key, $permissions)) {
                return true;
            } else if (is_string($permissions) && strcmp($permissions, $permission->key) == 0) {
                return true;
            }
        }
        return false;
    }
}
