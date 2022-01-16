<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    protected $table = 'roles';
    protected $fillable = [
        'name' ,  'created_at', 'updated_at'
    ];

    public function users()
    {
        $this->hasMany(Admin::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class,'role_permissions','role_id','permission_id');
    }
}
