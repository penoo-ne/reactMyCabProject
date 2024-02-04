<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;


class Role extends Model
{
    use HasApiTokens, HasFactory;
    protected $fillable = [
        'name',
        'status',
        'is_deleted',
    ];
    // //a role can be assign only one user
    // public function users(){
    //     return $this->belongsToOne(User::class,'user_role');
    // }
    // ////one role can have more then one permissions
    // public function permissions(){
    //     return $this->belongsToMany(Permission::class,'	role_permissions');
    // }

    // public function hasPermission($permission){
    //     return $this->permissions->contains('name', $permission);
    // }

    
//////user_roles

    public function users()
    {
        return $this->belongsTo(User::class,'role_id');
    }



////////////role_permissions
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions');
    }
}
